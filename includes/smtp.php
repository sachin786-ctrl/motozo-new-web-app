<?php
declare(strict_types=1);

/**
 * Lightweight Zero-Dependency SMTP Client
 * Supports SSL (port 465) and TLS / STARTTLS (port 587)
 * Works reliably on Localhost (XAMPP) and Live Servers with Gmail, Zoho, Outlook, etc.
 */
class SimpleSMTP {
    private string $host;
    private int $port;
    private string $encryption;
    private string $username;
    private string $password;
    private int $timeout;
    private string $lastError = '';

    public function __construct(array $config, int $timeout = 15) {
        $this->host       = (string)($config['host'] ?? 'smtp.gmail.com');
        $this->port       = (int)($config['port'] ?? 587);
        $this->encryption = strtolower((string)($config['encryption'] ?? 'tls'));
        $this->username   = (string)($config['username'] ?? '');
        $this->password   = (string)($config['password'] ?? '');
        $this->timeout    = $timeout;
    }

    public function getLastError(): string {
        return $this->lastError;
    }

    public function send(
        string $fromEmail,
        string $fromName,
        array $toEmails,
        string $replyTo,
        string $subject,
        string $htmlBody
    ): bool {
        $this->lastError = '';

        if (empty($this->username) || empty($this->password)) {
            $this->lastError = 'SMTP Username or Password is empty. Please set your Gmail App Password in config/mail.php.';
            return false;
        }

        $remoteSocket = ($this->encryption === 'ssl' ? 'ssl://' : 'tcp://') . $this->host . ':' . $this->port;

        $context = stream_context_create([
            'ssl' => [
                'verify_peer'       => false,
                'verify_peer_name'  => false,
                'allow_self_signed' => true,
            ]
        ]);

        $errno = 0;
        $errstr = '';
        $socket = @stream_socket_client($remoteSocket, $errno, $errstr, $this->timeout, STREAM_CLIENT_CONNECT, $context);

        if (!$socket) {
            $this->lastError = "Connection failed to {$remoteSocket}: $errstr ($errno)";
            return false;
        }

        stream_set_timeout($socket, $this->timeout);

        if (!$this->expect($socket, [220])) {
            fclose($socket);
            return false;
        }

        // Send EHLO
        $clientHost = gethostname() ?: 'localhost';
        if (!$this->cmd($socket, "EHLO {$clientHost}", [250])) {
            fclose($socket);
            return false;
        }

        // STARTTLS if TLS encryption
        if ($this->encryption === 'tls') {
            if (!$this->cmd($socket, "STARTTLS", [220])) {
                fclose($socket);
                return false;
            }

            $cryptoMethod = STREAM_CRYPTO_METHOD_TLS_CLIENT;
            if (defined('STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT')) {
                $cryptoMethod |= STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT;
            }
            if (defined('STREAM_CRYPTO_METHOD_TLSv1_3_CLIENT')) {
                $cryptoMethod |= STREAM_CRYPTO_METHOD_TLSv1_3_CLIENT;
            }

            if (!stream_socket_enable_crypto($socket, true, $cryptoMethod)) {
                $this->lastError = 'Failed to establish TLS encryption with SMTP server.';
                fclose($socket);
                return false;
            }

            if (!$this->cmd($socket, "EHLO {$clientHost}", [250])) {
                fclose($socket);
                return false;
            }
        }

        // AUTH LOGIN
        if (!$this->cmd($socket, "AUTH LOGIN", [334])) {
            fclose($socket);
            return false;
        }

        if (!$this->cmd($socket, base64_encode($this->username), [334])) {
            fclose($socket);
            return false;
        }

        // Clean spaces from App Password (e.g. 'abcd efgh ijkl mnop' -> 'abcdefghijklmnop')
        $cleanPassword = str_replace(' ', '', $this->password);
        if (!$this->cmd($socket, base64_encode($cleanPassword), [235])) {
            $this->lastError = 'SMTP Authentication failed. For Gmail, make sure you use a 16-character App Password, not your standard Gmail login password. (Server: ' . $this->lastError . ')';
            fclose($socket);
            return false;
        }

        // MAIL FROM
        if (!$this->cmd($socket, "MAIL FROM:<{$fromEmail}>", [250])) {
            fclose($socket);
            return false;
        }

        // RCPT TO for each recipient
        foreach ($toEmails as $to) {
            $to = trim((string)$to);
            if ($to === '') continue;
            if (!$this->cmd($socket, "RCPT TO:<{$to}>", [250, 251])) {
                fclose($socket);
                return false;
            }
        }

        // DATA
        if (!$this->cmd($socket, "DATA", [354])) {
            fclose($socket);
            return false;
        }

        // Prepare MIME Message
        $encodedSubject  = '=?UTF-8?B?' . base64_encode($subject) . '?=';
        $encodedFromName = '=?UTF-8?B?' . base64_encode($fromName) . '?=';
        $toHeader        = implode(', ', $toEmails);
        $dateHeader      = date('r');
        $msgId           = '<' . md5(uniqid((string)mt_rand(), true)) . '@' . ($clientHost ?: 'motozo.in') . '>';

        $headers = [
            "Date: {$dateHeader}",
            "Message-ID: {$msgId}",
            "From: {$encodedFromName} <{$fromEmail}>",
            "Reply-To: <{$replyTo}>",
            "To: {$toHeader}",
            "Subject: {$encodedSubject}",
            "MIME-Version: 1.0",
            "Content-Type: text/html; charset=UTF-8",
            "Content-Transfer-Encoding: base64",
            "X-Mailer: Motozo-Mailer",
        ];

        $payload = implode("\r\n", $headers) . "\r\n\r\n" . chunk_split(base64_encode($htmlBody)) . "\r\n.\r\n";

        fwrite($socket, $payload);
        if (!$this->expect($socket, [250])) {
            fclose($socket);
            return false;
        }

        // QUIT
        $this->cmd($socket, "QUIT", [221]);
        fclose($socket);
        return true;
    }

    private function cmd($socket, string $command, array $expectedCodes): bool {
        fwrite($socket, $command . "\r\n");
        return $this->expect($socket, $expectedCodes);
    }

    private function expect($socket, array $expectedCodes): bool {
        $response = '';
        while (!feof($socket)) {
            $line = fgets($socket, 512);
            if ($line === false) break;
            $response .= $line;
            if (isset($line[3]) && $line[3] === ' ') {
                break;
            }
        }

        $code = (int)substr($response, 0, 3);
        if (!in_array($code, $expectedCodes, true)) {
            $this->lastError = trim($response);
            return false;
        }
        return true;
    }
}

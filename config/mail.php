<?php
/**
 * Motozo Mail Configuration
 * 
 * Supports both Localhost (XAMPP) and Live Hosting.
 * To send emails via Gmail SMTP, generate a 16-character App Password from:
 * https://myaccount.google.com/apppasswords
 */
return [
  // Email address where lead notifications will be delivered:
  'to'        => ['sachink27263@gmail.com'],

  // Sender details:
  'from'      => 'sachink27263@gmail.com',
  'from_name' => 'Motozo Leads',

  // Driver: 'smtp' (recommended for reliable delivery) or 'mail' (PHP default mail)
  'driver'    => 'smtp',

  // SMTP Settings:
  'smtp'      => [
    'host'       => 'smtp.gmail.com',
    'port'       => 587,                   // 587 for TLS, 465 for SSL
    'encryption' => 'tls',                   // 'tls' or 'ssl'
    'username'   => 'sachink27263@gmail.com',
    'password'   => 'hgwh jxlj rkop eihp', // Google 16-character App Password
  ],
];
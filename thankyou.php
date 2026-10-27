<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Thank You</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <style>
    :root {
      --green: #1B692C;
      --text: #333333;
      --bg: #ffffff;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    html,
    body {
      height: 100%;
    }

    body {
      display: flex;
      align-items: center;
      justify-content: center;
      background: var(--bg);
      color: var(--text);
      font-family: "Poppins", system-ui, -apple-system, "Segoe UI", sans-serif;
    }

    .card {
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      padding: 24px;
    }

    /* ---------- Icon ---------- */
    .icon {
      position: relative;
      width: 116px;
      height: 116px;
      margin-bottom: 44px;
    }

    .circle {
      position: absolute;
      inset: 0;
      border-radius: 50%;
      background: var(--green);
      transform: scale(0);
      opacity: 0;
    }

    /* expanding ripple rings */
    .ring {
      position: absolute;
      inset: 0;
      border-radius: 50%;
      border: 3px solid var(--green);
      opacity: 0;
      transform: scale(1);
    }

    .check {
      position: absolute;
      inset: 0;
      width: 100%;
      height: 100%;
      overflow: visible;
    }

    .check path {
      fill: none;
      stroke: #fff;
      stroke-width: 6;
      stroke-linecap: round;
      stroke-linejoin: round;
      stroke-dasharray: 70;
      stroke-dashoffset: 70;
    }

    /* ---------- Text ---------- */
    h1 {
      font-size: 24px;
      font-weight: 600;
      margin-bottom: 14px;
      opacity: 0;
      transform: translateY(14px);
    }

    p {
      font-size: 20px;
      font-weight: 400;
      opacity: 0;
      transform: translateY(14px);
    }

    /* ---------- Animation (runs when .play is on the card) ---------- */
    .play .circle {
      animation: pop 0.6s cubic-bezier(0.34, 1.56, 0.64, 1) 0.1s forwards;
    }

    .play .ring {
      animation: ripple 1.1s ease-out 0.55s forwards;
    }

    .play .ring.r2 {
      animation-delay: 0.8s;
    }

    .play .check path {
      animation: draw 0.5s ease-out 0.6s forwards;
    }

    .play h1 {
      animation: rise 0.6s ease-out 1.0s forwards;
    }

    .play p {
      animation: rise 0.6s ease-out 1.2s forwards;
    }

    @keyframes pop {
      0% {
        transform: scale(0);
        opacity: 0;
      }

      100% {
        transform: scale(1);
        opacity: 1;
      }
    }

    @keyframes draw {
      to {
        stroke-dashoffset: 0;
      }
    }

    @keyframes ripple {
      0% {
        transform: scale(1);
        opacity: 0.55;
      }

      100% {
        transform: scale(1.9);
        opacity: 0;
      }
    }

    @keyframes rise {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    /* ---------- Replay button ---------- */
    .replay {
      margin-top: 36px;
      padding: 8px 18px;
      font: 400 14px "Poppins", sans-serif;
      color: var(--text);
      background: transparent;
      border: 1px solid #d6d6d6;
      border-radius: 999px;
      cursor: pointer;
      opacity: 0;
      transition: background 0.2s, border-color 0.2s;
    }

    .play .replay {
      animation: rise 0.6s ease-out 1.6s forwards;
    }

    .replay:hover {
      background: #f4f4f4;
      border-color: #bdbdbd;
    }

    .replay:focus-visible {
      outline: 2px solid var(--green);
      outline-offset: 2px;
    }

    @media (max-width: 480px) {
      h1 {
        font-size: 22px;
      }

      p {
        font-size: 17px;
      }
    }

    @media (prefers-reduced-motion: reduce) {

      .play .circle,
      .play .check path,
      .play h1,
      .play p,
      .play .replay {
        animation-duration: 0.01s;
        animation-delay: 0s;
      }

      .play .ring {
        animation: none;
      }
    }
  </style>
</head>

<body>

  <main class="card" id="card">
    <div class="icon">
      <span class="ring"></span>
      <span class="ring r2"></span>
      <div class="circle"></div>
      <svg class="check" viewBox="0 0 116 116" aria-hidden="true">
        <path d="M30 59 L51 79 L87 38" />
      </svg>
    </div>

    <h1>Thank You!</h1>
    <p>Your form has been submitted.</p>
    <a href="index.php"> <button class="replay" id="replay" type="button">Back Home</button></a>
  </main>

  <script>
    const card = document.getElementById('card');
    const replayBtn = document.getElementById('replay');

    function play() {
      card.classList.remove('play');
      void card.offsetWidth; // reflow so the animation restarts
      card.classList.add('play');
    }

    replayBtn.addEventListener('click', play);
    window.addEventListener('load', play);
  </script>
</body>

</html>
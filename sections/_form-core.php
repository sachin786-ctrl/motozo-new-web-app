<script>
  window.MotozoForm = window.MotozoForm || {
    bind(form, ui) {
      const post = async () => {
        ui.msg.className = 'small fw-semibold mt-2 text-center';
        ui.msg.textContent = '';
        if (!form.checkValidity()) {
          form.reportValidity();
          return;
        }

        ui.btn.disabled = true;
        if (ui.spin) ui.spin.classList.remove('d-none');
        ui.txt.textContent = ui.busy;
        try {
          const r = await fetch('<?= BASE ?>send-mail.php', {
            method: 'POST',
            body: new FormData(form),
            credentials: 'same-origin'
          });
          const d = await r.json();
          const icon = document.createElement('i');
          if (d.ok) {
            ui.msg.classList.add('ok');
            icon.className = 'bi bi-check-circle-fill me-1';
            ui.msg.append(icon, d.message || 'Thank you! We will call you within 30 mins.');
            if (ui.onOk) ui.onOk();
          } else {
            ui.msg.classList.add('bad');
            ui.msg.textContent = d.error || 'Something went wrong. Please try again.';
          }
        } catch (err) {
          ui.msg.classList.add('bad');
          ui.msg.textContent = 'Network error. Please try again or call us directly.';
        } finally {
          ui.btn.disabled = false;
          if (ui.spin) ui.spin.classList.add('d-none');
          ui.txt.textContent = ui.idle;
        }
      };
      form.addEventListener('submit', e => {
        e.preventDefault();
        post();
      });
      return post;
    }
  };
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Global Reveal & Motion Observer (Runs reliably on initial load & refresh)
  (function() {
    function runReveal() {
      const rm = window.matchMedia && window.matchMedia('(prefers-reduced-motion:reduce)').matches;
      if (!('IntersectionObserver' in window)) {
        document.querySelectorAll('.reveal').forEach(el => el.classList.add('in'));
        return;
      }
      const io = new IntersectionObserver(es => es.forEach(e => {
        if (!e.isIntersecting) return;
        const t = e.target;
        io.unobserve(t);
        t.classList.add('in');
        if (t.dataset.count !== undefined && !rm && typeof count === 'function') count(t);
      }), { threshold: 0.1 });
      document.querySelectorAll('.reveal').forEach(el => io.observe(el));
    }
    if (document.readyState === 'loading') {
      document.addEventListener('DOMContentLoaded', runReveal);
    } else {
      runReveal();
    }
  })();
</script>

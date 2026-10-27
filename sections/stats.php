<!-- ==========================================================================
     STATS COMPONENT (Self-Contained: HTML + CSS + JS)
     ========================================================================== -->
<section class="stats" aria-label="Motozo in numbers">
  <div class="container">
    <div class="stats-card">
      <div class="stat"><i class="bi bi-emoji-smile"></i>
        <div><b data-count="3523" data-suffix="+">3,523+</b><span>Happy Customers</span></div>
      </div>
      <div class="stat"><i class="bi bi-car-front-fill"></i>
        <div><b data-count="5325" data-suffix="+">5,325+</b><span>Vehicles Scrapped</span></div>
      </div>
      <div class="stat"><i class="bi bi-geo-alt-fill"></i>
        <div><b data-count="12" data-suffix="+">12+</b><span>Cities Covered</span></div>
      </div>
      <div class="stat"><i class="bi bi-leaf"></i>
        <div><b>Cleaner</b><span>Greener Tomorrow</span></div>
      </div>
      <div class="stat stat-hl"><i class="bi bi-flower1"></i><span>Together we build a sustainable future.</span></div>
    </div>
  </div>
</section>

<style>
  .stats {
    position: relative;
    margin-top: -4.5rem;
    margin-bottom: 2.2rem;
    z-index: 10;
  }

  .stats-card {
    background: #ffffff;
    border: 1px solid rgba(27, 105, 44, 0.12);
    /* border-radius: 12px; */
    box-shadow: 0 16px 40px -10px rgba(5, 35, 20, 0.12);
    padding: 1.8rem 1.8rem;
    display: grid;
    grid-template-columns: repeat(5, 1fr);
    gap: 1.2rem;
    align-items: center;
  }

  .stat {
    display: flex;
    align-items: center;
    gap: 1.1rem;
    padding: 0.6rem 1.2rem;
    border-right: 1px solid rgba(27, 105, 44, 0.12);
  }

  .stat:nth-child(4),
  .stat:last-child {
    border-right: 0;
  }

  .stat i {
    font-size: 2.8rem;
    color: var(--green-700, #1B692C);
    filter: drop-shadow(0 0 8px rgba(27, 105, 44, 0.45));
    line-height: 1;
    flex-shrink: 0;
  }

  .stat b {
    font-family: var(--font-body);
    font-size: 2.2rem;
    font-weight: 800;
    color: var(--green-700, #1B692C);
    display: block;
    line-height: 1.1;
    letter-spacing: -0.02em;
  }

  .stat span {
    color: var(--green-700, #1B692C);
    font-size: 0.96rem;
    font-weight: 500;
    display: block;
    margin-top: 4px;
    line-height: 1.35;
  }

  .stat:nth-child(4) b {
    color: var(--green-700, #1B692C);
    font-size: 1.9rem;
  }

  .stat-hl {
    background: var(--color-primary-soft, #EEF7F1);
    border: 1px solid rgba(27, 105, 44, 0.2);
    border-radius: 8px;
    padding: 0.85rem 1.1rem;
    color: var(--color-primary, #1B692C);
    font-weight: 600;
  }

  .stat-hl i {
    color: var(--color-primary, #1B692C);
    font-size: 1.8rem;
  }

  .stat-hl span {
    color: var(--color-primary, #1B692C);
    font-size: 0.88rem;
    font-weight: 600;
    margin-top: 0;
  }

  @media (max-width: 991px) {
    .stats {
      margin-top: -3rem;
      margin-bottom: 1.5rem;
    }

    .stats-card {
      grid-template-columns: repeat(2, 1fr);
      padding: 1.8rem 1.5rem;
      gap: 1.2rem;
    }

    .stat {
      border-right: 0;
      padding: 0.5rem 0.6rem;
    }

    .stat:nth-child(5) {
      grid-column: span 2;
    }
  }

  @media (max-width: 575.98px) {
    .stats {
      margin-top: -2rem;
      margin-bottom: 1rem;
    }

    .stats-card {
      grid-template-columns: repeat(2, 1fr);
      padding: 1.15rem 0.85rem;
      gap: 0.75rem;
    }

    .stat {
      padding: 0.35rem 0.2rem;
      gap: 0.5rem;
    }

    .stat i {
      font-size: 1.85rem;
    }

    .stat b {
      font-size: 1.35rem;
    }

    .stat span {
      font-size: 0.75rem;
      margin-top: 2px;
    }

    .stat:nth-child(4) b {
      font-size: 1.25rem;
    }

    .stat-hl {
      grid-column: span 2;
      padding: 0.75rem 0.85rem;
      gap: 0.65rem;
    }

    .stat-hl i {
      font-size: 1.6rem;
    }

    .stat-hl span {
      font-size: 0.82rem;
    }
  }
</style>

<script>
  (function() {
    const rm = matchMedia('(prefers-reduced-motion:reduce)').matches;

    function count(el) {
      const t = +el.dataset.count,
        d = +(el.dataset.decimals || 0),
        s = el.dataset.suffix || '';
      let st = null;
      const f = ts => {
        st = st || ts;
        const p = Math.min((ts - st) / 1400, 1);
        el.textContent = (t * p).toLocaleString('en-IN', {
          minimumFractionDigits: d,
          maximumFractionDigits: d
        }) + s;
        if (p < 1) requestAnimationFrame(f);
      };
      requestAnimationFrame(f);
    }

    const obs = new IntersectionObserver(es => {
      es.forEach(e => {
        if (!e.isIntersecting) return;
        obs.unobserve(e.target);
        if (!rm) count(e.target);
      });
    }, {
      threshold: 0.3
    });

    document.querySelectorAll('.stats [data-count]').forEach(el => obs.observe(el));
  })();
</script>
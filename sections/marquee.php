<!-- ==========================================================================
     MARQUEE TICKER COMPONENT (Self-Contained: HTML + CSS + JS)
     ========================================================================== -->
<section class="marquee-band" aria-label="Materials and services">
  <div class="marquee" id="mqA"></div>
  <div class="m-strip">
    <div class="marquee rev" id="mqB"></div>
  </div>
</section>

<style>
  .marquee-band {
    padding: 3rem 0 0;
    overflow: hidden;
    position: relative;
    width: 100%;
    max-width: 100%;
  }

  .marquee {
    display: flex;
    width: max-content;
    will-change: transform;
  }

  .m-big {
    display: flex;
    align-items: center;
    gap: .8rem;
    padding: 0 1.6rem;
    font-family: var(--font-body);
    font-weight: 800;
    font-size: clamp(2rem, 5vw, 3.6rem);
    white-space: nowrap;
    font-size: 2rem;
  }

  .m-big i {
    color: var(--green-500);
    font-size: 0.7em;
    font-weight: 400;
    -webkit-text-stroke: -2.4px;

  }

  .m-big:nth-child(even) {
    color: transparent;
    -webkit-text-stroke: 1px var(--green-600);
  }

  .m-strip {
    background: var(--green-700);
    color: #fff;
    margin-top: 1.5rem;
    display: flex;
    align-items: center;
    min-height: 58px;
    overflow: hidden;
  }

  .m-small {
    display: flex;
    align-items: center;
    white-space: nowrap;
    border-right: 1px solid rgba(255, 255, 255, .2);
    transition: all .2s ease;
  }

  .m-small.is-small,
  .m-small:nth-child(odd) {
    font-size: 0.88rem;
    font-weight: 500;
    gap: .5rem;
    padding: 0.85rem 1.4rem;
    opacity: 0.9;
    text-transform: capitalize;
    letter-spacing: 0.01em;
    color: #e2f4ea;
  }

  .m-small.is-small i,
  .m-small:nth-child(odd) i {
    font-size: 0.85rem;
    color: #93e2b6;
    opacity: 0.9;
  }

  .m-small.is-big,
  .m-small:nth-child(even) {
    font-size: 0.88rem;
    font-weight: 700;
    font-family: var(--font-body);
    gap: .65rem;
    padding: 0.85rem 1.65rem;
    text-transform: capitalize;
    letter-spacing: 0.01em;
    color: #ffffff;
    background: rgba(0, 0, 0, 0.1);
  }

  .m-small.is-big i,
  .m-small:nth-child(even) i {
    font-size: 1.02rem;
    color: var(--accent);
    filter: drop-shadow(0 0 4px rgba(47, 191, 113, 0.45));
  }

  @media (max-width: 575.98px) {
    .marquee-band {
      padding: 1.8rem 0 0;
    }

    .m-big {
      font-size: clamp(1.4rem, 5.5vw, 2.2rem);
      padding: 0 0.9rem;
      gap: 0.5rem;
    }

    .m-strip {
      margin-top: 1rem;
      min-height: 44px;
    }

    .m-small.is-small,
    .m-small:nth-child(odd) {
      font-size: 0.78rem;
      padding: 0.55rem 0.85rem;
    }

    .m-small.is-big,
    .m-small:nth-child(even) {
      font-size: 0.85rem;
      padding: 0.55rem 0.95rem;
    }
  }
</style>

<script>
  (function() {
    const mqA = document.getElementById('mqA');
    const mqB = document.getElementById('mqB');

    if (!mqA || !mqB) return;

    const rm = matchMedia('(prefers-reduced-motion: reduce)').matches;

    const mats = [
      ['car-front-fill', 'Car'],
      ['bicycle', 'Bike'],
      ['bus-front-fill', 'Bus'],
      ['truck', 'Commercial'],
      ['truck-front-fill', 'Truck'],
      ['gear-wide-connected', 'Other More']
    ];

    const svc = [
      'Verified Vehicle Scraping',
      'Authorised RVSF Partner',
      'Instant Payment',
      'Free Doorstep Pickup',
      'e-RTO Paperwork',
      'Doorstep Pickup',
      'Pan-India Network',
      'Govt. Authorized RVSF'
    ];

    const matsHtml = mats
      .map(m => `<div class="m-big"><i class="bi bi-${m[0]}"></i>${m[1]}</div>`)
      .join('');

    const svcHtml = svc
      .map((s, idx) => {
        const isBig = idx % 2 === 1;
        const icon = isBig ?
          'bi-patch-check-fill' :
          'bi-check-circle-fill';

        return `<div class="m-small fw-bold ${isBig ? 'is-big' : 'is-small'}"><i class="bi ${icon}"></i>${s}</div>`;
      })
      .join('');

    // Repeated content for seamless looping
    mqA.innerHTML = matsHtml.repeat(4);
    mqB.innerHTML = svcHtml.repeat(4);

    let posA = 0;
    let posB = 0;
    let initOffset = false;

    // Fixed speed: page scrolling does not affect animation
    const speedA = 0.9;
    const speedB = 0.8;

    let inView = true;

    const band = document.querySelector('.marquee-band');

    if (band && 'IntersectionObserver' in window) {
      new IntersectionObserver(([entry]) => {
        inView = entry.isIntersecting;
      }, {
        rootMargin: '250px 0px'
      }).observe(band);
    }

    function tickMarquee() {
      requestAnimationFrame(tickMarquee);

      if (!inView || rm) return;

      const halfA = mqA.scrollWidth / 2;

      if (halfA > 0) {
        posA -= speedA;

        if (posA <= -halfA) {
          posA += halfA;
        }

        mqA.style.transform = `translate3d(${posA}px, 0, 0)`;
      }

      const halfB = mqB.scrollWidth / 2;

      if (halfB > 0) {
        if (!initOffset) {
          posB = -halfB / 2;
          initOffset = true;
        }

        posB += speedB;

        if (posB >= 0) {
          posB -= halfB;
        }

        mqB.style.transform = `translate3d(${posB}px, 0, 0)`;
      }
    }

    requestAnimationFrame(tickMarquee);
  })();
</script>
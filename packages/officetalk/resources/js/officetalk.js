/**
 * OfficeTalk – Client-seitige Interaktionen.
 *
 * Scope bewusst klein gehalten. Livewire übernimmt State, Alpine
 * kleine Toggles. Hier nur, was nativ gehört: Scroll-Progress,
 * Section-Divider-Reveal, Sticky-Nav-Shrink.
 */

(function () {
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    /* --- Scroll-Progress-Indikator --- */
    function initScrollProgress() {
        const progress = document.querySelector('[data-officetalk-progress]');
        if (!progress) return;

        let ticking = false;

        function update() {
            const scrolled = window.scrollY;
            const max = document.documentElement.scrollHeight - window.innerHeight;
            const pct = max > 0 ? (scrolled / max) * 100 : 0;
            progress.style.width = `${pct}%`;
            ticking = false;
        }

        window.addEventListener(
            'scroll',
            () => {
                if (!ticking) {
                    window.requestAnimationFrame(update);
                    ticking = true;
                }
            },
            { passive: true }
        );
        update();
    }

    /* --- Section-Divider-Reveal --- */
    function initDividerReveal() {
        if (prefersReducedMotion) return;
        const dividers = document.querySelectorAll('[data-officetalk-divider]');
        if (!dividers.length || !('IntersectionObserver' in window)) return;

        const io = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('is-revealed');
                        io.unobserve(entry.target);
                    }
                });
            },
            { threshold: 0.2 }
        );

        dividers.forEach((d) => io.observe(d));
    }

    /* --- Sticky-Nav-Shrink --- */
    function initNavShrink() {
        const nav = document.querySelector('[data-officetalk-nav]');
        if (!nav) return;

        function onScroll() {
            if (window.scrollY > 40) {
                nav.dataset.compact = 'true';
            } else {
                delete nav.dataset.compact;
            }
        }

        window.addEventListener('scroll', onScroll, { passive: true });
        onScroll();
    }

    /* --- Init --- */
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            initScrollProgress();
            initDividerReveal();
            initNavShrink();
        });
    } else {
        initScrollProgress();
        initDividerReveal();
        initNavShrink();
    }
})();

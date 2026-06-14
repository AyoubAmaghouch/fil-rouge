/**
 * VICITY CAR — Admin Panel JavaScript
 * Counter animations + sidebar mobile toggle.
 */

document.addEventListener('DOMContentLoaded', () => { // Wait for the html to be fully loaded

    /* ── ANIMATED STAT COUNTERS ── */
    const statValues = document.querySelectorAll('.stat-value'); // Select all elements with the class 'stat-value'

    if (statValues.length) {
        const observer = new IntersectionObserver(
            (entries) => {
                entries.forEach((entry) => {
                    if (entry.isIntersecting) {
                        const el = entry.target;
                        const target = parseInt(el.getAttribute('data-count'), 10) || 0;
                        animateCounter(el, target);
                        observer.unobserve(el);
                    }
                });
            },
            { threshold: 0.4 }
        );

        statValues.forEach((el) => observer.observe(el));
    }

    function animateCounter(element, target) {
        const duration = 1200; // ms
        const startTime = performance.now();
        const startValue = 0;

        function step(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1.0);

            // Ease-out cubic
            const eased = 1 - Math.pow(1 - progress, 3);

            const current = Math.round(startValue + (target - startValue) * eased);
            element.textContent = current;

            if (progress < 1) {
                requestAnimationFrame(step);
            } else {
                element.textContent = target;
            }
        }

        requestAnimationFrame(step);
    }

    /* ── SIDEBAR MOBILE TOGGLE ── */
    const toggleBtn = document.querySelector('.sidebar-toggle');
    const sidebar = document.querySelector('.admin-sidebar');
    const overlay = document.querySelector('.sidebar-overlay');

    if (toggleBtn && sidebar) {
        toggleBtn.addEventListener('click', () => {
            document.body.classList.toggle('sidebar-open');
        });
    }

    if (overlay) {
        overlay.addEventListener('click', () => {
            document.body.classList.remove('sidebar-open');
        });
    }

    /* ── ACTIVE SIDEBAR LINK ── */
    const sidebarLinks = document.querySelectorAll('.sidebar-nav a');
    const currentPath = window.location.pathname;

    sidebarLinks.forEach((link) => {
        const href = link.getAttribute('href');
        if (href && currentPath.endsWith(href.replace(/^\.\.\//, ''))) {
            link.classList.add('active');
        }
    });

});

/**
 * BİKGRUP - Ana JavaScript Motoru
 * Çizgisel Mimari & Scrolled Navbar Dinleyicisi
 */

document.addEventListener('DOMContentLoaded', () => {
    // 1. Akıllı Scrolled Navbar Kontrolü (Anasayfada çizgisel çerçeveden sonra belirir)
    const headerWrapper = document.querySelector('.header-wrapper');
    const adlerHero = document.querySelector('.adler-hero-viewport');

    if (headerWrapper && adlerHero) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 450) {
                headerWrapper.classList.add('header-visible');
            } else {
                headerWrapper.classList.remove('header-visible');
            }
        }, { passive: true });
    }

    // 2. Mobil Menü Açma/Kapama
    const mobileToggles = document.querySelectorAll('.mobile-toggle');
    const mobileDrawer = document.querySelector('.mobile-menu-drawer');
    const mobileClose = document.querySelector('.mobile-menu-close');

    if (mobileToggles.length > 0 && mobileDrawer) {
        mobileToggles.forEach(toggle => {
            toggle.addEventListener('click', () => {
                mobileDrawer.classList.add('active');
                document.body.style.overflow = 'hidden';
            });
        });

        const closeDrawer = () => {
            mobileDrawer.classList.remove('active');
            document.body.style.overflow = '';
        };

        if (mobileClose) mobileClose.addEventListener('click', closeDrawer);
        mobileDrawer.addEventListener('click', (e) => {
            if (e.target === mobileDrawer) closeDrawer();
        });
    }

    // 3. Scroll Reveal Animasyonları (IntersectionObserver)
    const revealElements = document.querySelectorAll('.reveal');
    if ('IntersectionObserver' in window) {
        const revealObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.15,
            rootMargin: '0px 0px -40px 0px'
        });

        revealElements.forEach(el => revealObserver.observe(el));
    } else {
        revealElements.forEach(el => el.classList.add('active'));
    }
});

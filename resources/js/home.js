document.addEventListener('DOMContentLoaded', function () {

    // Navbar scroll effect
    const navbar = document.getElementById('mainNavbar');

    if (navbar) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 60) {
                navbar.classList.remove('at-top');
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.add('at-top');
                navbar.classList.remove('scrolled');
            }
        });
    }

    // Mobile menu
    const mobileMenuBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');

    if (mobileMenuBtn && mobileMenu) {
        mobileMenuBtn.addEventListener('click', () => {
            const isOpen = mobileMenu.style.display === 'block';
            mobileMenu.style.display = isOpen ? 'none' : 'block';
        });

        mobileMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.style.display = 'none';
            });
        });
    }

    // Fade animation
    const fadeEls = document.querySelectorAll('.fade-up');

    if (fadeEls.length > 0) {
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, { threshold: 0.12 });

        fadeEls.forEach(el => observer.observe(el));
    }

    // Smooth scroll
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            const target = document.querySelector(this.getAttribute('href'));

            if (target) {
                e.preventDefault();
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

});
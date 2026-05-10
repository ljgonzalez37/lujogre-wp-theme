/**
 * lujogre.com — main.js v2.0
 * Nav · Scroll · Animations · Contact form
 */
(function () {
    'use strict';

    /* Nav toggle */
    var toggle = document.getElementById('nav-toggle');
    var nav    = document.getElementById('main-nav');
    if (toggle && nav) {
        toggle.addEventListener('click', function () {
            var open = nav.classList.toggle('is-open');
            toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
        });
        document.addEventListener('click', function (e) {
            if (!nav.contains(e.target) && !toggle.contains(e.target)) {
                nav.classList.remove('is-open');
                toggle.setAttribute('aria-expanded', 'false');
            }
        });
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                nav.classList.remove('is-open');
                toggle.setAttribute('aria-expanded', 'false');
                toggle.focus();
            }
        });
    }

    /* Header scroll shadow */
    var header = document.getElementById('site-header');
    if (header) {
        window.addEventListener('scroll', function () {
            header.style.boxShadow = window.scrollY > 10 ? '0 2px 20px rgba(0,0,0,.28)' : 'none';
        }, { passive: true });
    }

    /* Card entrance animation */
    if ('IntersectionObserver' in window) {
        var cards = document.querySelectorAll('.card, .post-card, .portfolio-card, .talk-row, .uni-card, .pub-card, .engagement-card, .bio-block, .topic-row');
        cards.forEach(function (el) {
            el.style.opacity   = '0';
            el.style.transform = 'translateY(14px)';
            el.style.transition = 'opacity .35s ease, transform .35s ease';
        });
        var obs = new IntersectionObserver(function (entries) {
            entries.forEach(function (e) {
                if (e.isIntersecting) {
                    e.target.style.opacity   = '1';
                    e.target.style.transform = 'translateY(0)';
                    obs.unobserve(e.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -28px 0px' });
        cards.forEach(function (el) { obs.observe(el); });
    }

    /* Smooth anchor scroll */
    document.querySelectorAll('a[href^="#"]').forEach(function (a) {
        a.addEventListener('click', function (e) {
            var target = document.querySelector(this.getAttribute('href'));
            if (target) {
                e.preventDefault();
                window.scrollTo({ top: target.getBoundingClientRect().top + window.scrollY - 80, behavior: 'smooth' });
            }
        });
    });

}());

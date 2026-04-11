document.addEventListener('DOMContentLoaded', function () {
    const urlRoot = document.body.dataset.urlroot || '';

    const reveals = document.querySelectorAll('.reveal');

    const revealOnScroll = () => {
        reveals.forEach((item) => {
            const top = item.getBoundingClientRect().top;
            const windowHeight = window.innerHeight;

            if (top < windowHeight - 80) {
                item.classList.add('active');
            }
        });
    };

    revealOnScroll();
    window.addEventListener('scroll', revealOnScroll);

    const menuToggle = document.getElementById('menuToggle');
    const navLinks = document.getElementById('navLinks');

    if (menuToggle && navLinks) {
        menuToggle.addEventListener('click', function () {
            navLinks.classList.toggle('show');
            const expanded = navLinks.classList.contains('show');
            menuToggle.setAttribute('aria-expanded', expanded ? 'true' : 'false');
        });
    }

    const dashboardSearch = document.getElementById('dashboardSearch');

    if (dashboardSearch) {
        dashboardSearch.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
                const value = dashboardSearch.value.toLowerCase().trim();

                if (value.includes('task')) {
                    window.location.href = urlRoot + '/tasks';
                } else if (value.includes('subject')) {
                    window.location.href = urlRoot + '/subjects';
                } else if (value.includes('planner')) {
                    window.location.href = urlRoot + '/planner';
                } else if (value.includes('focus')) {
                    window.location.href = urlRoot + '/focus';
                } else if (value.includes('progress')) {
                    window.location.href = urlRoot + '/progress';
                } else if (value.includes('profile')) {
                    window.location.href = urlRoot + '/profile';
                } else if (value.includes('dashboard') || value.includes('home')) {
                    window.location.href = urlRoot + '/dashboard';
                }
            }
        });
    }

    const forms = document.querySelectorAll('form');

    forms.forEach((form) => {
        form.addEventListener('submit', function () {
            const submitBtn = form.querySelector('button[type="submit"]');
            if (submitBtn) {
                submitBtn.classList.add('loading-btn');
            }
        });
    });
});
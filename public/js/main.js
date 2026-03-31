document.addEventListener('DOMContentLoaded', function () {
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
        });
    }

    const dashboardSearch = document.getElementById('dashboardSearch');
    if (dashboardSearch) {
        dashboardSearch.addEventListener('keydown', function (e) {
            if (e.key === 'Enter') {
                const value = dashboardSearch.value.toLowerCase().trim();

                if (value.includes('task')) {
                    window.location.href = window.location.origin + '/studyflow-ai/tasks';
                } else if (value.includes('subject')) {
                    window.location.href = window.location.origin + '/studyflow-ai/subjects';
                } else if (value.includes('planner')) {
                    window.location.href = window.location.origin + '/studyflow-ai/planner';
                } else if (value.includes('focus')) {
                    window.location.href = window.location.origin + '/studyflow-ai/focus';
                } else if (value.includes('progress')) {
                    window.location.href = window.location.origin + '/studyflow-ai/progress';
                }
            }
        });
    }
});
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
});
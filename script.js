//Funcion scroll navbar
function onReady(callback) {
    if (document.readyState !== 'loading') {
        callback();
    } else {
        document.addEventListener('DOMContentLoaded', callback);
    }
}

onReady(function() {
    // Obtenemos el elemento navbar por su ID
    var navbar = document.getElementById('navbar');

    // Comprobamos si el navbar existe para evitar errores
    if (navbar) {
        window.addEventListener('scroll', scrollFunction);

        function scrollFunction() {
            var scrollThreshold = 50;
            if (document.body.scrollTop > scrollThreshold || document.documentElement.scrollTop > scrollThreshold) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        }

        scrollFunction();
    }

    const navToggle = document.getElementById('navToggle');
    const navLinks = document.getElementById('navLinks');

    if (navToggle && navLinks) {
        navToggle.addEventListener('click', function() {
            navToggle.classList.toggle('open');
            navLinks.classList.toggle('open');
            const expanded = navToggle.classList.contains('open');
            navToggle.setAttribute('aria-expanded', expanded ? 'true' : 'false');
        });

        navLinks.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => {
                if (navLinks.classList.contains('open')) {
                    navLinks.classList.remove('open');
                    navToggle.classList.remove('open');
                    navToggle.setAttribute('aria-expanded', 'false');
                }
            });
        });
    }
});

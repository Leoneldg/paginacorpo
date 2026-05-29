//Funcion scroll navbar
// Espera a que el DOM esté completamente cargado
document.addEventListener('DOMContentLoaded', function() {
    // Obtenemos el elemento navbar por su ID
    var navbar = document.getElementById('navbar');

    // Comprobamos si el navbar existe para evitar errores
    if (navbar) {
        // Función que se ejecuta al hacer scroll
        window.onscroll = function() {
            scrollFunction();
        };

        function scrollFunction() {
            // Define el umbral de scroll. Ajusta este valor si quieres que el cambio ocurra antes o después.
            var scrollThreshold = 50; // Por ejemplo, 50px de scroll

            // Comprobamos la posición del scroll
            // document.body.scrollTop para Chrome, Safari, Opera
            // document.documentElement.scrollTop para Firefox, IE
            if (document.body.scrollTop > scrollThreshold || document.documentElement.scrollTop > scrollThreshold) {
                // Si el scroll supera el umbral, añade la clase 'scrolled'
                navbar.classList.add("scrolled");
            } else {
                // Si el scroll vuelve a estar por encima del umbral, quita la clase 'scrolled'
                navbar.classList.remove("scrolled");
            }
        }
    }
});

document.addEventListener("DOMContentLoaded", function() {
    // Cambio de fondo en el header al hacer scroll
    window.addEventListener("scroll", function() {
        let header = document.querySelector("header");
        if (window.scrollY > 50) {
            header.style.backgroundColor = "rgba(34, 34, 34, 0.95)";
        } else {
            header.style.backgroundColor = "rgba(34, 34, 34, 0.9)";
        }
    });

    // Mensaje de bienvenida dinámico
    const saludo = document.createElement("p");
    const hora = new Date().getHours();
    let mensaje;
    if (hora < 12) {
        mensaje = "¡Buenos días! Explora el museo y disfruta del arte.";
    } else if (hora < 18) {
        mensaje = "¡Buenas tardes! Sumérgete en nuestras exposiciones.";
    } else {
        mensaje = "¡Buenas noches! Disfruta de nuestro museo virtual.";
    }
    saludo.textContent = mensaje;
    document.getElementById("inicio").appendChild(saludo);
});

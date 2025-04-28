<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión - Museo Virtual</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
    <header>
        <h1>Museo Virtual</h1>
        <nav>
            <ul>
                <li><a href="index.php">Inicio</a></li>
                <li><a href="exposiciones.php">Exposiciones</a></li>
                <li><a href="galeria.php">Galería</a></li>
                <li><a href="contacto.php">Contacto</a></li>
                <li><a href="comentarios.php">Comentarios</a></li>
            </ul>
        </nav>
    </header>

    <section id="inicio">
        <div class="textoIndex">
            <h2>Inicio de sesión</h2>

            <!-- Cambiado a formulario real -->
            <form action="procesar_login.php" method="POST" class="formulario-login">
                <p>Ingresar correo:</p>
                <input type="email" name="correo" required style="width: 300px; height: 20px; padding: 10px; border: 2px solid #4892d6; border-radius: 5px; background-color: #f9f9f9; color: #333; font-size: 16px; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">

                <p>Ingresar contraseña:</p>
                <input type="password" name="contrasena" required style="width: 300px; height: 20px; padding: 10px; border: 2px solid #4892d6; border-radius: 5px; background-color: #f9f9f9; color: #333; font-size: 16px; box-shadow: 0 2px 5px rgba(0,0,0,0.2);">

                <p></p>
                <button type="submit" class="boton-bonito">Ingresar</button>
            </form>
        </div>
    </section>

    <script type="text/javascript">
        function mostrarMensaje() {
            const urlParams = new URLSearchParams(window.location.search);
            const mensaje = urlParams.get('mensaje');

            if (mensaje === 'debes_loguearte') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Atención',
                    text: 'Debes iniciar sesión para acceder a esta sección.',
                    confirmButtonText: 'Aceptar'
                });
                window.history.replaceState({}, document.title, window.location.pathname);
            } else if (mensaje === 'error_credenciales') {
                Swal.fire({
                    icon: 'error',
                    title: 'Error de acceso',
                    text: 'Correo o contraseña incorrectos.',
                    confirmButtonText: 'Intentar de nuevo'
                });
                window.history.replaceState({}, document.title, window.location.pathname);
            }
        }

        mostrarMensaje();
    </script>

</body>

</html>

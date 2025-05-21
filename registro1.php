
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - Museo Virtual</title>
    <link rel="stylesheet" href="styles.css">
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
                <li><a href="reportes.php">Reportes</a></li>
            </ul>
        </nav>
    </header>

    <section id="inicio">
        <div class="textoIndex">
            <h2>Registro de Usuario</h2>

            <form action="registro.php" method="POST" class="formulario-registro">
                <div class="campo-formulario">
                    <label for="nombre">Nombre:</label>
                    <input type="text" name="nombre" id="nombre" required>
                </div>

                <div class="campo-formulario">
                    <label for="correo">Correo electrónico:</label>
                    <input type="email" name="correo" id="correo" required>
                </div>

                <div class="campo-formulario">
                    <label for="contrasena">Contraseña:</label>
                    <input type="password" name="contrasena" id="contrasena" required>
                </div>

                <div class="campo-formulario">
                    <label for="telefono">Teléfono (opcional):</label>
                    <input type="tel" name="telefono" id="telefono">
                </div>

                <div class="campo-formulario">
                    <button type="submit" class="boton-bonito">Registrarse</button>
                </div>
            </form>
        </div>
    </section>

</body>

</html>
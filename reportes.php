<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reportes - Museo Virtual</title>
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
                <li><a href="comentarios.php">Comentarios</a></li>
            </ul>
        </nav>
    </header>

    <section id="reporte-acceso">
        <h2>Acceso a Reportes de Administración</h2>
        <p>Por favor, elige una opción:</p>
        <a href="admin_login.php"><button>Iniciar sesión</button></a>
        <a href="admin_registro.php"><button>Registrar nuevo administrador</button></a>
    </section>

    <footer>
        <p>&copy; 2025 Museo Virtual. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
<?php
exit();
}
// ¡Aquí conectamos a la base de datos!  
$conexion = new mysqli("localhost", "root", "", "museo");
if ($conexion->connect_error) {
    die("Conexión fallida: " . $conexion->connect_error);
}
// Insertar registro de reporte
$fecha = date('Y-m-d');
$tipo = "Acceso a Reportes";
$idAdmin = $_SESSION['admin_id'];

$stmt = $conexion->prepare("INSERT INTO Reporte (Fecha, Tipo, ID_Admin) VALUES (?, ?, ?)");
$stmt->bind_param("ssi", $fecha, $tipo, $idAdmin);
$stmt->execute();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reportes - Museo Virtual</title>
    <link rel="stylesheet" href="styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<header>
    <h1>Museo Virtual</h1>
    <nav>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="exposiciones.php">Exposiciones</a></li>
            <li><a href="galeria.php">Galería</a></li>
            <li><a href="comentarios.php">Comentarios</a></li>
            <li><a href="reportes.php">Reportes</a></li>
            <?php if (isset($_SESSION['usuario_nombre'])): ?>
                <li><a href="#">Hola, <?php echo htmlspecialchars($_SESSION['usuario_nombre']); ?> 👋</a></li>
                <li><a href="logout.php">Cerrar sesión</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

<section id="reportes">
    <h2>📈 Reportes del Museo</h2>

    <?php
    // Reporte 1: Total de visitas por exposición
    $visitas = $conexion->query("
        SELECT e.Titulo, COUNT(v.ID_Visita) AS total_visitas
        FROM Visita v
        JOIN Exhibicion e ON v.ID_Exhibicion = e.ID_Exhibicion
        GROUP BY e.ID_Exhibicion
    ");

    $titulos_visitas = [];
    $valores_visitas = [];

    echo "<h3>Visitas por exposición</h3><ul>";
    while ($fila = $visitas->fetch_assoc()) {
        echo "<li><strong>{$fila['Titulo']}</strong>: {$fila['total_visitas']} visitas</li>";
        $titulos_visitas[] = $fila['Titulo'];
        $valores_visitas[] = $fila['total_visitas'];
    }
    echo "</ul>";
    ?>

    <canvas id="graficoVisitas" width="400" height="200"></canvas>

    <?php
    // Reporte 2: Comentarios por exposición
    $comentarios = $conexion->query("
        SELECT e.Titulo, COUNT(c.ID_Comentario) AS total_comentarios
        FROM Comentario c
        JOIN Exhibicion e ON c.ID_Exhibicion = e.ID_Exhibicion
        GROUP BY e.ID_Exhibicion
    ");

    echo "<h3>Comentarios por exposición</h3><ul>";
    while ($fila = $comentarios->fetch_assoc()) {
        echo "<li><strong>{$fila['Titulo']}</strong>: {$fila['total_comentarios']} comentarios</li>";
    }
    echo "</ul>";
    ?>

    <?php
    // Reporte 3: Valoración promedio por exposición
    $valoraciones = $conexion->query("
        SELECT e.Titulo, ROUND(AVG(c.Valoracion), 2) AS promedio
        FROM Comentario c
        JOIN Exhibicion e ON c.ID_Exhibicion = e.ID_Exhibicion
        GROUP BY e.ID_Exhibicion
    ");

    $titulos_val = [];
    $valores_prom = [];

    echo "<h3>Valoración promedio por exposición</h3><ul>";
    while ($fila = $valoraciones->fetch_assoc()) {
        echo "<li><strong>{$fila['Titulo']}</strong>: {$fila['promedio']} / 5 estrellas</li>";
        $titulos_val[] = $fila['Titulo'];
        $valores_prom[] = $fila['promedio'];
    }
    echo "</ul>";
    ?>

    <canvas id="graficoValoraciones" width="400" height="200"></canvas>

    <?php
    // Reporte 4: Total de usuarios
    $usuarios = $conexion->query("SELECT COUNT(*) AS total_usuarios FROM Usuario")->fetch_assoc();
    echo "<h3>Usuarios registrados</h3><p>Total: {$usuarios['total_usuarios']} usuarios</p>";

    // Reporte 5: Últimos comentarios
    $ultimos = $conexion->query("
        SELECT u.Nombre, e.Titulo, c.Texto, c.Fecha
        FROM Comentario c
        JOIN Usuario u ON c.ID_Usuario = u.ID_Usuario
        JOIN Exhibicion e ON c.ID_Exhibicion = e.ID_Exhibicion
        ORDER BY c.Fecha DESC LIMIT 5
    ");

    echo "<h3>Últimos comentarios</h3><ul>";
    while ($fila = $ultimos->fetch_assoc()) {
        echo "<li><strong>{$fila['Nombre']}</strong> sobre <em>{$fila['Titulo']}</em>: " .
             substr(htmlspecialchars($fila['Texto']), 0, 60) . "... <small>({$fila['Fecha']})</small></li>";
    }
    echo "</ul>";
    ?>
</section>

<script>
    const ctxVisitas = document.getElementById('graficoVisitas').getContext('2d');
    const graficoVisitas = new Chart(ctxVisitas, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($titulos_visitas); ?>,
            datasets: [{
                label: 'Visitas por exposición',
                data: <?php echo json_encode($valores_visitas); ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.5)',
                borderColor: 'rgb(54, 162, 235)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    title: { display: true, text: 'Número de visitas' }
                }
            }
        }
    });

    const ctxValoraciones = document.getElementById('graficoValoraciones').getContext('2d');
    const graficoValoraciones = new Chart(ctxValoraciones, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($titulos_val); ?>,
            datasets: [{
                label: 'Valoración promedio',
                data: <?php echo json_encode($valores_prom); ?>,
                backgroundColor: 'rgba(255, 206, 86, 0.5)',
                borderColor: 'rgb(255, 206, 86)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true,
                    max: 5,
                    title: { display: true, text: 'Estrellas' }
                }
            }
        }
    });
</script>
<section id="cerrar-sesion" style="margin-top: 40px; text-align: center;">
    <form action="logout.php" method="POST">
        <button type="submit" class="boton-bonito">Cerrar sesión</button>
    </form>
</section>
<footer>
    <p>&copy; 2025 Museo Virtual. Todos los derechos reservados.</p>
</footer>

</body>
</html>
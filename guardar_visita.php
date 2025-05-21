<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    http_response_code(403);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tiempo = isset($_POST['tiempo']) ? intval($_POST['tiempo']) : 0;
    $id_exhibicion = isset($_POST['id_exhibicion']) ? intval($_POST['id_exhibicion']) : 0;

    if ($tiempo > 0 && $id_exhibicion > 0) {
        $conexion = new mysqli("localhost", "root", "", "museo");
        if ($conexion->connect_error) {
            http_response_code(500);
            exit();
        }

        $fechaHora = date("Y-m-d H:i:s");
        $id_usuario = $_SESSION['usuario_id'];

        $stmt = $conexion->prepare("INSERT INTO Visita (TiempoVisualizacion, FechaHora, ID_Usuario, ID_Exhibicion) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isii", $tiempo, $fechaHora, $id_usuario, $id_exhibicion);
        $stmt->execute();
        $stmt->close();
        $conexion->close();
    }
}
?>

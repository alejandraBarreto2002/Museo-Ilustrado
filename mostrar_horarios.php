<?php
$conn = new mysqli("localhost", "root", "", "museo"); // Cambia a tu base de datos
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener días únicos
$dias = [];
$resDias = $conn->query("SELECT DISTINCT Dia FROM Horario ORDER BY FIELD(Dia, 'Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo')");
while ($row = $resDias->fetch_assoc()) {
    $dias[] = $row['Dia'];
}

// Día seleccionado
$diaSeleccionado = isset($_GET['dia']) ? $conn->real_escape_string($_GET['dia']) : null;

// Consulta
if ($diaSeleccionado) {
$stmt = $conn->prepare("SELECT * FROM Horario WHERE Dia = ?");
$stmt->bind_param("s", $diaSeleccionado);
$stmt->execute();
$result = $stmt->get_result();
} else {
// Mostrar todos los horarios si no se seleccionó un día específico
$result = $conn->query("SELECT * FROM Horario ORDER BY FIELD(Dia, 'Lunes','Martes','Miércoles','Jueves','Viernes','Sábado','Domingo')");
}
?>
<div class="horarios-container">
    <h2>Consulta los horarios del museo</h2>
    <form method="GET" action="galeria.php">
        <label for="dia">Selecciona un día:</label>
        <select name="dia" id="dia">
            <option value="">-- Todos los días --</option>
            <?php foreach ($dias as $dia): ?>
                <option value="<?php echo htmlspecialchars($dia); ?>" <?php echo ($dia === $diaSeleccionado) ? 'selected' : ''; ?>><?php echo htmlspecialchars($dia); ?></option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Consultar">
    </form>

    <?php if ($result && $result->num_rows > 0): ?>
        <table class="horarios-tabla">
    <tr>
        <?php if (!$diaSeleccionado): ?>
            <th>Día</th>
        <?php endif; ?>
        <th>Apertura</th>
        <th>Cierre</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <?php if (!$diaSeleccionado): ?>
                <td><?php echo htmlspecialchars($row["Dia"]); ?></td>
            <?php endif; ?>
            <td><?php echo htmlspecialchars($row["Apertura"]); ?></td>
            <td><?php echo htmlspecialchars($row["Cierre"]); ?></td>
        </tr>
    <?php endwhile; ?>
</table>
    <?php elseif ($diaSeleccionado): ?>
        <p>No hay horarios disponibles para el día seleccionado.</p>
    <?php endif; ?>
</div>

<?php
session_start();
session_destroy();
// Redirigir con un mensaje
header("Location: index.php?mensaje=sesion_cerrada");
exit();

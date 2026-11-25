<?php
session_start();
require_once __DIR__ . '/files/funciones.php';

if (!usuario_autenticado()) {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Opciones</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php echo pantalla_opciones(); ?>
</body>
</html>

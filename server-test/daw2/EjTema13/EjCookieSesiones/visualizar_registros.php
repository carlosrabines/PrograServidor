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
    <title>Visualizar registros</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php
    if (isset($_GET['busqueda']) && $_GET['busqueda'] === 'no_encontrado') {
        $dniBuscado = isset($_GET['dni']) ? (string) $_GET['dni'] : '';
        echo pantalla_sin_registro_busqueda($dniBuscado);
    } else {
        echo pantalla_registros();
    }
    ?>
</body>
</html>

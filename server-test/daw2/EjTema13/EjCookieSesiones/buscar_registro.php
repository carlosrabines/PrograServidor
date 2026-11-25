<?php
session_start();
require_once __DIR__ . '/files/funciones.php';

if (!usuario_autenticado()) {
    header('Location: index.php');
    exit();
}

$dni = '';
$error = '';
$registroEncontrado = null;
$dniEncontrado = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dni = trim((string) ($_POST['dni_busqueda'] ?? ''));
    $dniNormalizado = strtoupper(str_replace([' ', '-'], '', $dni));

    if ($dniNormalizado === '') {
        $error = 'Debe ingresar un DNI';
    } else {
        $registros = $_SESSION['registro'] ?? [];

        if (is_array($registros) && isset($registros[$dniNormalizado])) {
            $dniEncontrado = $dniNormalizado;
            $registroEncontrado = $registros[$dniNormalizado];
        } else {
            header('Location: visualizar_registros.php?busqueda=no_encontrado&dni=' . rawurlencode($dniNormalizado));
            exit();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Buscar un Registro</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php
    if ($registroEncontrado !== null) {
        echo pantalla_registro_buscado($dniEncontrado, $registroEncontrado);
    } else {
        echo pantalla_buscar_registro($dni, $error);
    }
    ?>
</body>
</html>

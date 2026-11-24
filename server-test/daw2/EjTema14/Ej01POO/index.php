<?php
    require_once __DIR__ . '/MiCabecera.php';

    $cabecera = new MiCabecera(
        'Titulo Generado con Clase: MiCabecera.php',
        'Sub-Titulo Generado con Clase: MiCabecera.php',
    );
/*
    $nombre = '';
    $apellido = '';
    if (isset($_POST['s_nombre'], $_POST['s_apellido'])
        && is_string($_POST['s_nombre'])
        && is_string($_POST['s_apellido'])) {
        $nombre = htmlspecialchars($_POST['s_nombre'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
        $apellido = htmlspecialchars($_POST['s_apellido'], ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }
*/
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejemplo de MiCabecera</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?= $cabecera ?>
    <main>
        <p>Parrafo: Esta página utiliza la clase <code>MiCabecera</code> para generar su cabecera.</p>
  
        <br><br><p><a href="segunda_pagina.php">ir a la siguiente pagina</a></p>
    </main>
</body>
</html>

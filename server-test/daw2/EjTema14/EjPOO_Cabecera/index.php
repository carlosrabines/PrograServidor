<?php
    require_once __DIR__ . '/MiCabecera.php';

    $cabecera = new MiCabecera(
        'Titulo Generado con Clase: MiCabecera.php',
        'Sub-Titulo Generado con Clase: MiCabecera.php',
    );
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

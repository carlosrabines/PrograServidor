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
        <p>Ejercicio con las clases <code>Customer</code> y <code>Libro</code>.</p>

        <p><a href="visualizar_datos.php?tipo_visualiza=1">Visualizar Clientes y Libros - Por Atributo</a></p>
        <p><a href="visualizar_datos.php?tipo_visualiza=2">Visualizar Clientes y Libros - Version toString</a></p>
    </main>
</body>
</html>

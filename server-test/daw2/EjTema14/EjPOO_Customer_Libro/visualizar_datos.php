<?php
    require_once __DIR__ . '/MiCabecera.php';
    require_once __DIR__ . '/files/funciones.php';

    $cabecera = new MiCabecera(
        'Clientes y libros',
        'Datos almacenados en las clases Customer y Libro'
    );
    $tipo_visualiza = (isset($_GET['tipo_visualiza'])) ? $_GET['tipo_visualiza'] : 1;

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Visualización de clientes y libros</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <!-- AQUI LLAMO A LA FUNCION PARA MOSTRAR LA PANTALLA -->
</body>
    <?php
        echo visualiza_datos($tipo_visualiza); 
    ?>
</html>

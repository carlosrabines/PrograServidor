<?php

    $coloresValidos = ['celeste', 'rosa'];
    $idiomasValidos = ['es', 'en', 'fr'];

    /*
        Valida si existen cookies que indiquen color e idiona seleccionado, si existe la cookie
        valida que el color e idioma guardados sigan siendo válidos, si es así,
        llama directamente a introducir_cv y ya no muestra la pantalla de inicio.
    */ 
    if (isset($_COOKIE['set_color'], $_COOKIE['set_idioma'])
        && in_array($_COOKIE['set_color'], $coloresValidos, true)
        && in_array($_COOKIE['set_idioma'], $idiomasValidos, true)) {
        header('Location: introducir_cv.php');
        exit();
    }

    require_once("files/funciones.php");

    $mi_Heredoc = pantalla_inicio();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio Cookies - Idioma, Color y CV</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php
        echo $mi_Heredoc;
    ?>
</body>
</html>
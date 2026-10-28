<?php

    require_once("files/setcookies.php");
    require("files/funciones.php");

    $mi_Heredoc = pantalla_inicio();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ejercicio Cookies</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php
        echo $mi_Heredoc;

        echo "<hr><h3>Contenido de las cookies:</h3>";
        include("files/vercookies.php");
    ?>
</body>
</html>
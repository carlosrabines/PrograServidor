<?php
    session_start();
    if (!isset($_SESSION['cod_usuario']) ||
        !isset($_COOKIE['s_usuario']) &&
        $_SESSION['cod_usuario'] != $_COOKIE['s_usuario']) {
        header('Location: index.php');
        exit();
    }
    $usuario = $_SESSION['cod_usuario'];
?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Ejercicio Cookies - Sesiones</title>
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <?php
            require_once("files/funciones.php");
            $mi_Heredoc = solicita_informacion($usuario);
            echo $mi_Heredoc;
       ?>
    </body>
</html>
<?php
    session_start();
    if (isset($_SESSION['cod_usuario']) &&
        isset($_COOKIE['s_usuario']) &&
        $_SESSION['cod_usuario'] == $_COOKIE['s_usuario']) {
        header('Location: ingreso_datos.php');
        exit();
    }
    echo $_SESSION['cod_usuario'];

    if (isset($_REQUEST['s_usuario'])) {
        $usuario = $_REQUEST['s_usuario'];
        $clave = $_REQUEST['s_clave'];

        setcookie('s_usuario', $usuario, time() + (30 * 24 * 60 * 60), "/");
        $_SESSION['cod_usuario'] = $usuario;

        header('Location: ingreso_datos.php');
        exit();
    }

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
            $mi_Heredoc = pantalla_inicio();
            echo $mi_Heredoc;require_once("files/funciones.php");
       ?>
    </body>
</html>
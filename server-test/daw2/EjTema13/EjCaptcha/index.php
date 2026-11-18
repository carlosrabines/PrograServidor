<?php
    if (!extension_loaded("gd") || !function_exists("gd_info")) {
            $s_captcha = "No se cuenta con la librería GD cargada";
            $s_textousr = "No se cuenta con la librería GD cargada";
            $msj = "No se puede generar Captcha !!";
            $color = "black";
            header('Location: error.php?s_msj=' . urlencode($msj) . '&s_captcha=' . urlencode($s_captcha) . '&s_textousr=' . urlencode($s_textousr));
            exit();
    }

/*
    session_start();
    session_unset();
    session_destroy();
    session_start();
*/

    if (isset($_REQUEST['s_captcha']) && isset($_REQUEST['s_textousr'])) {
        if ($_REQUEST['s_captcha'] == $_REQUEST['s_textousr']) {
            $msj = "Captcha validado correctamente !!";
            $color = "blue";
        } else {
            $msj = "Captcha incorrecto !!";
            $color = "red";
        }
        $s_captcha = $_REQUEST['s_captcha'];
        $s_textousr = $_REQUEST['s_textousr'];
        header('Location: resultado.php?s_msj=' . urlencode($msj) . '&s_captcha=' . urlencode($s_captcha) . '&s_textousr=' . urlencode($s_textousr) . '&s_color=' . urlencode($color));
        exit();
    }

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Ejercicio Captcha</title>
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <?php
        
            require_once("files/funciones.php");
            $mi_Heredoc = pantalla_inicio();
            echo $mi_Heredoc;
       ?>
    </body>
</html>
<?php
    if (!extension_loaded("gd") || !function_exists("gd_info")) {
            $s_captcha = "No se cuenta con la librería GD cargada";
            $s_textousr = "No se cuenta con la librería GD cargada";
            $msj = "No se puede generar Captcha !!";
            $color = "black";
            header('Location: error.php?s_msj=' . urlencode($msj) . '&s_captcha=' . urlencode($s_captcha) . '&s_textousr=' . urlencode($s_textousr));
            exit();
    }

    if (isset($_REQUEST['s_captcha']) && isset($_REQUEST['s_textousr'])) {
        if ($_REQUEST['s_captcha'] == $_REQUEST['s_textousr']) {
            $s_captcha = $_REQUEST['s_captcha'];
            $s_textousr = $_REQUEST['s_textousr'];
            $msj = "NO ERES UN ROBOT !!";
            $color = "blue";
            header('Location: noerror.php?s_msj=' . urlencode($msj) . '&s_captcha=' . urlencode($s_captcha) . '&s_textousr=' . urlencode($s_textousr) . '&s_color=' . urlencode($color));
            exit();
        } else {
            $s_captcha = $_REQUEST['s_captcha'];
            $s_textousr = $_REQUEST['s_textousr'];
            $msj = "Ingreso no corresponde a la imagen Captcha !!";
            $color = "red";
            header('Location: error.php?s_msj=' . urlencode($msj) . '&s_captcha=' . urlencode($s_captcha) . '&s_textousr=' . urlencode($s_textousr) . '&s_color=' . urlencode($color));
            exit();
        }
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

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>El ahorcado</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php   

        require("php/funciones.php");

        $datos = validaciones();
        $accion = $datos['accion'];
        $palabra_ahorcado = $datos['palabra_ahorcado'];
        $letras_seleccionadas = $datos['letras_seleccionadas'];
        $html_alert = $datos['html_alert'];
        $letra_fallos = $datos['letra_fallos'];
        $falta_acertar = 0;
        $html_palabra_mostrar = mostrar_palabra($palabra_ahorcado, $letras_seleccionadas, $falta_acertar);

        $mi_Heredoc = pantalla_inicio($accion, $letras_seleccionadas, $html_palabra_mostrar, $html_alert, $letra_fallos, $falta_acertar);

        echo $mi_Heredoc;
    ?>
        
</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Funciones de Cadena</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php

        require("files/funciones.php");

        $mi_Heredoc= "";
        $accion = "";
        $s_izquierda = "";
        $s_centro = "";
        $t_centro = "";
        //Si no hay dato principal (se deben validar todos)
        if(isset($_REQUEST["accion"])) {
            $accion = $_REQUEST["accion"];

            $s_izquierda = $_REQUEST["s_izquierda"];
            $s_centro = $_REQUEST["s_centro"];
            $t_centro = $_REQUEST["t_centro"];

            $s_izquierda = trim($s_izquierda);
            $s_centro = trim($s_centro);
            $t_centro = trim($t_centro);
        }
        
        $mi_Heredoc = pantalla_inicio($accion, $s_izquierda, $s_centro, $t_centro);

        echo $mi_Heredoc;
    ?>
        
</body>
</html>
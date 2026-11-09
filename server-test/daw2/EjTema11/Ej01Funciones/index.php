
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Funciones Tablas</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php

        require("files/funciones.php");

        $accion = isset($_REQUEST["accion"]) ? $_REQUEST["accion"] : "";
        $nfilas = isset($_REQUEST["n_filas"]) ? $_REQUEST["n_filas"] : 1;
        $ncolumnas = isset($_REQUEST["n_columnas"]) ? $_REQUEST["n_columnas"] : 1;

        $mi_Heredoc = pantalla_inicio($accion, $nfilas, $ncolumnas);

        echo $mi_Heredoc;
    ?>
        
</body>
</html>
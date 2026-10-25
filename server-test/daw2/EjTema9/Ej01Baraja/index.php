
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Baraja</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php

        require("files/funciones.php");

        $accion = isset($_REQUEST["accion"]) ? $_REQUEST["accion"] : "";
        $n_cantidad = isset($_REQUEST["n_cantidad"]) ? $_REQUEST["n_cantidad"] : 12;
        if (empty($accion)) {
            $palos = ["bastos", "copas", "espadas", "oros"];
            $orden = "Ascendente";
            $n_cantidad = 12;
        } else {
            $palos = isset($_REQUEST['palos']) ? $_REQUEST['palos'] : [];
            $orden = isset($_REQUEST['orden']) ? $_REQUEST['orden'] : "Ascendente";
        }

        $mi_Heredoc = pantalla_inicio($accion, $n_cantidad, $palos, $orden);

        echo $mi_Heredoc;
    ?>
        
</body>
</html>
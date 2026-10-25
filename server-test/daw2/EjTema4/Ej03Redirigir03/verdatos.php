
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Redirigida</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php

        require("files/funciones.php");

        $mi_Heredoc= "";

        //Si no hay dato principal (se deben validar todos)
         if(!isset($_GET['s_usr'])) {
            $mi_Heredoc = "Se ha ejecutado directamento, no valido !!";
         } else {

            $s_usr = $_GET['s_usr'];

            $html = "<h1>Mostrar Datos - Redirigida</h1>"
            ."<form action='index.php' method='POST' >\n"
                ."<table>\n"
                    ."<tr>\n"
                        ."<td><label> Usuario: $s_usr</label></td>\n"
                        ."<td><button type='submit' value='Volver ' >Volver</button>\n"
                . "</tr>\n"
                . "</table>\n";
            $html .= "</form>\n";

            $mi_Heredoc = $html;
         }
        echo $mi_Heredoc;

    ?>
</body>
</html>
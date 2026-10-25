
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
         if(!isset($_GET['s_msj'])) {
            $mi_Heredoc = "Se ha ejecutado directamento, no valido !!";
         } else {

            $s_msj = $_GET['s_msj'];
            $n_valida = $_GET['n_valida'];

            $html = "<h1>Pantalla - Error</h1>"
            ."<form action='index.php' method='POST' >\n"
                ."<table>\n"
                    ."<tr>\n"
                        ."<td><label> $s_msj</label></td>\n";
                        if ($n_valida !=0) {
                            $html .= "<td><button type='submit' value='Volver ' >Volver</button>\n"
                                . "</tr>\n";
                        } else {
                            $id = uniqid();
                            $html .= "</tr>\n"
                            ."<tr>\n"
                                ."<td><a href='index.php'>Volver a validarse</a></td>\n"
                            . "</tr>\n"
                            ."<tr>\n"
                                ."<td><a href='registro.php?s_usr=f#" . $id 
                                . "'>Registro</a></td>\n"
                            . "</tr>\n";
                        }
            $html .= "</table>\n"
            . "</form>\n";

            $mi_Heredoc = $html;
         }
        echo $mi_Heredoc;

    ?>
</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="5; url=index.php">    
    <title>Error de Inicio Sesion</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php

        $mi_Heredoc= "";

        //Si no hay dato principal (se deben validar todos)
         if(!isset($_GET['s_msj'])) {
            $mi_Heredoc = "Se ha ejecutado directamento, no valido !!";
         } else {

            $s_msj = $_GET['s_msj'];
            $s_color = 'red';

            $html = "<h1>ERROR DE INICIO DE SESION</h1>"
            ."<form action='index.php' method='POST' >\n"
                ."<table>\n"
                    ."<tr>\n"
                        ."<td><label style='color: $s_color;'> $s_msj</label></td>\n"
                    ."</tr>\n"
                . "</table>\n"
            ."</form>\n";

            $mi_Heredoc = $html;
         }
        echo $mi_Heredoc;

    ?>
</body>
</html>
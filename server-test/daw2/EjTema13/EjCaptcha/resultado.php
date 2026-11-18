
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Resultado</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php

        $mi_Heredoc= "";

        //Si no hay dato principal (se deben validar todos)
         if(!isset($_GET['s_msj']) || !isset($_GET['s_captcha']) ||
            !isset($_GET['s_textousr']) || !isset($_GET['s_color'])) {
            $mi_Heredoc = "Se ha ejecutado directamento, no valido !!";
         } else {

            $s_msj = strtoupper($_GET['s_msj']);
            $s_captcha = $_GET['s_captcha'];
            $s_textousr = $_GET['s_textousr'];
            $s_color = $_GET['s_color'];

            $html = "<h1>Resultado Valida Captcha</h1>"
            ."<form action='index.php' method='POST' >\n"
                ."<table>\n"
                    ."<tr>\n"
                        ."<td><label style='color: $s_color;'> $s_msj</label></td>\n"
                    ."</tr>\n"
                    ."<tr>\n"
                        ."<td><label style='color: $s_color;'> Texto Captcha: $s_captcha</label></td>\n"
                    ."</tr>\n"
                    ."<tr>\n"
                        ."<td><label style='color: $s_color;'> Texto Ingresado: $s_textousr</label></td>\n"
                    ."</tr>\n"
                    ."<tr>\n"
                        ."<td><button type='submit' class='botones' value='Volver ' >Volver</button>\n"
                    ."</tr>\n"
                . "</table>\n"
            ."</form>\n";

            $mi_Heredoc = $html;
         }
        echo $mi_Heredoc;

    ?>
</body>
</html>
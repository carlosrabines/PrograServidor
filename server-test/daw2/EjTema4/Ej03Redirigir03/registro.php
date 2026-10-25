
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

        $mi_Heredoc = "";
        $n_archivo = "files/usuarios.txt";

        //Si no hay dato principal (se deben validar todos)
         if(!isset($_POST['s_usr']) && !isset($_GET['s_usr'])) {
            $mi_Heredoc = "Se ha ejecutado directamento, no valido !!";
         } else {

            if (isset($_POST['s_pwd'])) {
                $s_usr = $_POST['s_usr'];
                $s_pwd = $_POST['s_pwd'];
                registra_usuario($s_usr, $s_pwd, $n_archivo);
            }

            $html = "<h1>Registro de Usuario</h1>"
            ."<form action='{$_SERVER['PHP_SELF']}' method='POST' >\n"
                ."<table>\n"
                    ."<tr>\n"
                        ."<td><label for='id_usr'> Usuario: </label><input type='text' id='id_usr' name='s_usr' required /></td>\n"
                        ."<td><label for='id_pwd'> Contraseña: </label><input type='password' id='id_pwd' name='s_pwd' required /></td>\n"
                        ."<td><button type='submit' value='Registrar' >Registrar</button>\n"
                . "</tr>\n"
                . "</table>\n";

            $html .= "<br><br>";


            $html .= muestra_usuario($n_archivo);

            $html .= "<br>\n"
                ."<a href='index.php'>Volver a validarse</a>\n"
            . "</form>\n";

            $mi_Heredoc = $html;
         }
        echo $mi_Heredoc;

    ?>
</body>
</html>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Redirigir</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php

        require("files/funciones.php");

        $mi_Heredoc= "";

        //Si no hay dato principal (se deben validar todos)
        if(!isset($_REQUEST["s_usr"]) || !isset($_REQUEST["s_pwd"])) {
            $mi_Heredoc = pantalla_inicio();
        } else {

            $s_usr = $_POST['s_usr'];
            $s_pwd = $_POST['s_pwd'];

            $validacion_usuario = valida_usuario($s_usr, $s_pwd);

            if ($validacion_usuario != 1) {
            
//                header("Refresh: 10; url=index.php");

                switch ($validacion_usuario) {
                    case 0:
                        $msj = "Usuario no existe !!";
                        break;
                    case 2:
                        $msj = "Password incorrecta !!";
                        break;
                    default:
                        $msj = "Error inesperado validando usuario !!";
                        break;
                }            

                header("Refresh: 10; url=error.php?s_msj=" . $msj);

                echo "<p>$msj</p>";
                echo "<p>Serás redirigido al formulario automáticamente en 10 segundos...</p>";
            
                exit();
            } else {
                header("Location: verdatos.php?s_usr=" . $s_usr);
                exit();

            } 

            $mi_Heredoc = pantalla_SegundaLLamada($s_usr, $s_pwd);
            $mi_Heredoc .= " <br> - " . $msj;
        }


        echo $mi_Heredoc;
    ?>
        
</body>
</html>
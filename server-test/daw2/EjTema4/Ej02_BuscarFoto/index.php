
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Datos</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php

        require("files/funciones.php");

        $mi_Heredoc= "";

        //Si no hay dato principal (se deben validar todos)
        if(!isset($_REQUEST["s_nombre"]) || !isset($_REQUEST["s_apellido"])) {
            $mi_Heredoc = pantalla_inicio();
        } else {

            $s_nombre = $_POST['s_nombre'];
            $s_apellido = $_POST['s_apellido'];
            $nombreDirectorio = "../ficheros_subidos/"; 
        // Hasta aquí voy
            if (!isset($_POST['archivo_foto'])) {
                $nombreBuscar = $nombreDirectorio . str_replace(" ", "", $s_apellido) . str_replace(" ", "", $s_nombre);
                
                $arr_archivos = glob($nombreBuscar . "*.{jpg,gif}", GLOB_BRACE);
    //            $phpFiles = glob($nombreBuscar . "*.jpg");
    //            $txtFiles = glob($nombreBuscar . "*.gif");
    //            $todos = array_merge($phpFiles, $txtFiles);

                if (empty($arr_archivos)) {
                    echo "No hay archivos para mostrar !!!";
                } else {
                    foreach ($arr_archivos as $archivo) {
                        echo $archivo . '<br>';
                    }
                }
                $mi_Heredoc = pantalla_SegundaLLamada($s_nombre, $s_apellido, $arr_archivos);
            } else {
                $arr_archivo_foto = $_POST['archivo_foto'];
                $s_archivo = $nombreDirectorio . $arr_archivo_foto[0];
                $mi_Heredoc = pantalla_MuestraFoto($s_nombre, $s_apellido, $s_archivo);
            }


        }
        echo $mi_Heredoc;
        
    ?>
</body>
</html>
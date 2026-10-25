
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
        if(!isset($_REQUEST["s_nombre"])) {
            $mi_Heredoc = pantalla_inicio();
        } else {
            $error_msj = "";
            //Si no se adjuntó archivo
            if (!isset($_FILES['s_archivo'])) {
                $error_msj = "Error: No se recibió ningún archivo (posiblemente excedió el tamaño)";
            } else {
                $codigoError = $_FILES['s_archivo']['error'];
//                echo "Error: " . $codigoError . "<br>";

                //si da algún eroor (valor != 0)
                if ($codigoError !== UPLOAD_ERR_OK) {
                    $error_msj = mensajeErrorArchivoSubido($codigoError);
                } else {
                    $nombreDirectorio = "../ficheros_subidos/"; 
                    if (!is_dir($nombreDirectorio)) {
                        $error_msj = "Error: No se pudo mover el archivo a la carpeta de destino en el servidor.";
                    } else {
                        $f_name = $_FILES['s_archivo']['name'];
                        $f_type = $_FILES['s_archivo']['type'];
                        $f_size = $_FILES['s_archivo']['size'];
                        $F_tmp_name = $_FILES['s_archivo']['tmp_name'];

                        $f_extension = pathinfo($f_name, PATHINFO_EXTENSION);

                        $aray_extensiones = ['jpg', 'gif'];

                        //si el archivo adjunto no es de la extensiñon permitida
                        if (!in_array($f_extension, $aray_extensiones)) {
                            $error_msj = "Error: Solo se pueden agregar extensiones de tipo" . implode(", ", $aray_extensiones);
                        }

                    }
                }
            }

            //si se presento algún error
            if (!empty($error_msj)) {
                echo htmlspecialchars($error_msj) . '<br><br>';
                $mi_Heredoc = pantalla_inicio();
            } else {
//                    echo "extension del archivo: " . $f_extension . "<br>";
                $s_nombre = $_POST['s_nombre'];
                $s_apellido = $_POST['s_apellido'];

                $fnac = $_POST['fnac'];
                $sexo = $_POST['sexo'];
                $idiomasSeleccionados = isset($_POST['idiomas']) ? $_POST['idiomas'] : [];
                $nacion= isset($_POST['nacion']) ? $_POST['nacion'] : [];
                $aficion = isset($_POST['aficion']) ? $_POST['aficion'] : [];

                $idUnico = uniqid();
//                $nombreCompleto = $nombreDirectorio . $s_apellido . $s_nombre . "_" . $idUnico . "." . $f_extension;
                $nombreCompleto = $nombreDirectorio . str_replace(" ", "", $s_apellido) . str_replace(" ", "", $s_nombre) . "_" . $idUnico . "." . $f_extension;



                move_uploaded_file ($_FILES['s_archivo']['tmp_name'],$nombreCompleto);
                $error_msj = "Archivo subido con éxito: " . $_FILES['s_archivo']['name'] . " (" . $_FILES['s_archivo']['type'] . ")";

                $mi_Heredoc = pantalla_SegundaLLamada($s_nombre, $s_apellido, $fnac, $sexo, $idiomasSeleccionados, $nacion, $aficion, $nombreCompleto);

            }

        }
        echo $mi_Heredoc;
        
    ?>
</body>
</html>
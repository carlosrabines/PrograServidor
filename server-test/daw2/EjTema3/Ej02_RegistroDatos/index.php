
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

        if(!isset($_REQUEST["s_nombre"])) {

            $mi_Heredoc = pantalla_inicio();
                    
        } else {


            $s_nombre = $_POST['s_nombre'];
            $s_apellido = $_POST['s_apellido'];
            $fnac = $_POST['fnac'];
            $sexo = $_POST['sexo'];
            $idiomasSeleccionados = isset($_POST['idiomas']) ? $_POST['idiomas'] : [];
            $nacion= isset($_POST['nacion']) ? $_POST['nacion'] : [];
            $aficion = isset($_POST['aficion']) ? $_POST['aficion'] : [];
            $mi_Heredoc = pantalla_SegundaLLamada($s_nombre, $s_apellido, $fnac, $sexo, $idiomasSeleccionados, $nacion, $aficion);
        }
/*
        $mi_Heredoc = <<<HTML
            <h1>Registro de Datos</h1>

            {$formulario}
                {$html_nom}
                {$html_ape}
                {$html_fnac}
                {$html_sexo}
                {$html_idiomas}
                {$html_nacinalidad}
                {$html_aficion}
                {$html_btn}
            </form>
        HTML;
*/
        echo $mi_Heredoc;
        
    ?>
</body>
</html>
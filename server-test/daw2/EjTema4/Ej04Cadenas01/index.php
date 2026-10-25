
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
        if(!isset($_REQUEST["s_aguja"]) || !isset($_REQUEST["s_pajar"])) {
            $mi_Heredoc = pantalla_inicio();
        } else {

            $s_aguja = $_POST['s_aguja'];
            $s_pajar = $_POST['s_pajar'];

            //$n_ocurrencias = cuenta_ocurrencias($s_aguja, $s_pajar);
/*            $arr_result = [];

            $n_posant = 1;
            $arr_new_result = devuelve_posiciones_recursiva($s_aguja, $s_pajar, $n_posant, $arr_result);
            if (!$arr_new_result) {
                $mi_Heredoc = "Ejecutado, listo  para mostrar resultados: << NO HAY POSICIONESD A MOSTRAR >>";
            } else {
                if (count($arr_resultado) > 0) {
                    $mi_Heredoc = "Ejecutado, listo  para mostrar resultados - posicionesa: ";
                    foreach ($arr_new_result as $result) {
                        $mi_Heredoc .= "<br>";
                        $mi_Heredoc .= " - " . $result;
                    }
                } else {
                    $mi_Heredoc = "Ejecutado, listo  para mostrar resultados: << NO HAY POSICIONESD A MOSTRAR >>";
                }
            }
*/
            $arr_resultado = devuelve_posiciones($s_aguja, $s_pajar);

            if (!$arr_resultado) {
                $mi_Heredoc = "Ejecutado, listo  para mostrar resultados: << NO HAY POSICIONESD A MOSTRAR >>";
            } else {
                if (count($arr_resultado) > 0) {
                    $mi_Heredoc = "Ejecutado, listo  para mostrar resultados - posicionesa: ";
                    foreach ($arr_resultado as $result) {
                        $mi_Heredoc .= "<br>";
                        $mi_Heredoc .= " - " . $result;
                    }
                } else {
                    $mi_Heredoc = "Ejecutado, listo  para mostrar resultados: << NO HAY POSICIONESD A MOSTRAR >>";
                }
            }
        }

        echo $mi_Heredoc;
    ?>
        
</body>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mes calendario</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
    <?php

        require("../files/variables.php");
        require("../files/funciones.php");

        $table_body = "";

        if(!isset($_REQUEST["respuestas"])) {

            $contador = 1;

            $n_aciertos = 0;
            $p_aciertos = 0;
            $n_fallos = 0;
            $p_fallos = 0;
            $n_sin_respuesta = 0;
            $p_sin_respuesta = 0;

            $n_preguntas = count($arr_verbos, COUNT_RECURSIVE) - count($arr_verbos);

        } else {

            $respuestas = $_REQUEST["respuestas"];

            $contador = $_REQUEST["contador"] + 1;

            $n_aciertos = $_REQUEST["n_aciertos"];
            $p_aciertos = $_REQUEST["p_aciertos"];
            $n_fallos = $_REQUEST["n_fallos"];
            $p_fallos = $_REQUEST["p_fallos"];
            $n_sin_respuesta = $_REQUEST["n_sin_respuesta"];
            $p_sin_respuesta = $_REQUEST["p_sin_respuesta"];

            $n_preguntas = $_REQUEST["n_preguntas"];

            // Recorrer el array asociativo
            foreach ($respuestas as $verbo_espanol => $formas_ingresadas) {
                // $formas_ingresadas: array con los 3 valores que el usuario escribió en inputs
                for ($i = 0; $i < count($formas_ingresadas); $i++) {
                    // Comprobar si la forma ingresada coincide con la forma correcta
                    if ($formas_ingresadas[$i] == $arr_verbos[$verbo_espanol][$i]) {
                        $n_aciertos++;
                    } else {
                        if (empty($formas_ingresadas[$i])) {
                            $n_sin_respuesta++;
                        } else {
                            $n_fallos++;
                        }
                    }
                }
            }

        }

        $table = "";
        if (!isset($_REQUEST["btaccion"])) {
            $btaccion = "";
        } else {
            $btaccion = $_REQUEST["btaccion"];
        }

        $btn_continuar = "";
        $btn_finalizar = "<button type='submit' name='btaccion' value='Finalizar'>Finalizar</button>\n"
                        ."<br><br>";
        $btn_volver = "";

        $formulario = "<form action='{$_SERVER['PHP_SELF']}' method='POST'>\n";

        if ( $btaccion != "Finalizar") {

            $table_lines = recorreArregloParcial(array_keys($arr_verbos), $contador);

            $table .= "<table>\n"
                    . "<thead>\n"
                        . "<tr>\n"
                            . "<td style='text-align: center;' ><strong>Verbo en español</strong></td>\n"
                            . "<td style='text-align: center;' ><strong>Infinitivo</strong></td>\n"
                            . "<td style='text-align: center;' ><strong>Pasado simple</strong></td>\n"
                            . "<td style='text-align: center;' ><strong>Participio pasado</strong></td>\n"
                        . "</tr>\n"
                    . "</thead>\n"
                    . "<tbody>\n"
                        . $table_lines
                    . "</tbody>"
                . "</table>\n"
                . "<div style='display: none;'>\n";

            //Si aún no llega al final de las preguntas genera botón continuar
            if ($contador < count($arr_verbos)) {
                $btn_continuar = "<button type='submit' name='btaccion' value='Continuar'>Continuar</button>\n"
                                ."<br><br>";                        
            }

        } else {
            //parte que la estadística se pueda visualizar
            $table = "<div>\n";
            //Si  ya hizo finalizar  que la estadística se pueda visualizar
            $btn_finalizar = "";
            $btn_volver  = "<button type='submit' name='btaccion' value='Nuevo Test'>Nuevo Test</button>\n"
                            ."<br><br>";

            $formulario = "<form action='{$_SERVER['PHP_SELF']}' method=''>\n";

            if ($n_aciertos + $n_fallos + $n_sin_respuesta != $n_preguntas) {
                $n_sin_respuesta = $n_preguntas - ($n_aciertos + $n_fallos);
            }

            $p_aciertos = number_format($n_aciertos / $n_preguntas * 100, 2, '.', ''); 
            $p_fallos = number_format($n_fallos / $n_preguntas * 100, 2, '.', ''); 
            $p_sin_respuesta = number_format($n_sin_respuesta / $n_preguntas * 100, 2, '.', ''); 

        }

        $table .= ""
                ."<table>\n"
                    ."<caption style='font-size: 25px;'> RESULTADOS FINALES DEL TEST</caption>\n"
                    ."<thead>\n"
                        ."<tr>\n"
                            ."<td style='background-color: green; color: white;'> Aciertos </td>\n"
                            ."<td style='background-color: green; color: white;'> % </td>\n"
                            ."<td style='background-color: red; color: white;'> Fallos </td>\n"
                            ."<td style='background-color: red; color: white;'> % </td>\n"
                            ."<td style='background-color: yellow;'> Sin respuesta </td>\n"
                            ."<td style='background-color: yellow;'> % </td>\n"
                            ."<td style='background-color: blue; color: white;'> TOTAL PREGUNTAS </td>\n"
                        ."</tr>\n"
                    ."</thead>\n"
                    ."<tbody>\n"
                        ."<tr>\n"
                            ."<td style='background-color: green; color: white;'>\n" 
                                ."<input type='hidden' name='n_aciertos' value='$n_aciertos' />\n"
                                .$n_aciertos
                            ."</td>\n"
                            ."<td style='background-color: green; color: white;'>\n" 
                                ."<input type='hidden' name='p_aciertos' value='$p_aciertos' />\n"
                                .$p_aciertos
                            ."</td>\n"
                            ."<td style='background-color: red; color: white;'>"
                                ."<input type='hidden' name='n_fallos' value='$n_fallos' />\n"
                                .$n_fallos
                            ."</td>\n"
                            ."<td style='background-color: red; color: white;'>\n" 
                                ."<input type='hidden' name='p_fallos' value='$p_fallos' />\n"
                                .$p_fallos
                            ."</td>\n"
                            ."<td style='background-color: yellow;'>"
                                ."<input type='hidden' name='n_sin_respuesta' value='$n_sin_respuesta' />\n"
                                .$n_sin_respuesta
                            ."</td>\n"
                            ."<td style='background-color: yellow;'>\n" 
                                ."<input type='hidden' name='p_sin_respuesta' value='$p_sin_respuesta' />\n"
                                .$p_sin_respuesta
                            ."</td>\n"
                            ."<td style='background-color: blue; color: white;'>\n"
                                ."<input type='hidden' name='n_preguntas' value='$n_preguntas' />\n"
                                .$n_preguntas
                            ."</td>\n"
                        ."</tr>\n"
                    ."</tbody>\n"
                ."</table>\n"
                ."<input type='hidden' name='contador' value='$contador' />\n"
            . "</div>\n";

        $mi_Heredoc = <<<HTML
                {$formulario}
                    <h1>Ingresa las formas verbales correctas en inglés </h1>\n
                    <br>
                    <br>
                    {$table}
                    <br>
                    {$btn_continuar}
                    {$btn_finalizar}
                    {$btn_volver}
                </form>\n
            HTML;
        echo $mi_Heredoc;

    ?>
</body>
</html>
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
        
        if(!isset($_REQUEST["respuestas"])) {

            function recorreArreglo(array $verbos) {
                $lineas = "";
                foreach($verbos as $llave) {
                    $lineas .= "<tr>\n"
                                . "<td style='text-align: center;' ><U>$llave</u></td>\n";

                    for ($i = 1; $i <= 3; $i++) {
                        $lineas .= "<td>\n"
                                    . "<input type='text' name='respuestas[$llave][]'/>\n"
                                . "</td>\n";
                    }

                    $lineas .= "</tr>\n";
    
                }

                return $lineas;
            }

            $table_lines = recorreArreglo(array_keys($arr_verbos));

            $table_body = "";
            $table_body .= "<table>\n"
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
                . "</table>\n";

            $mi_Heredoc = <<<HTML
                <form action="{$_SERVER['PHP_SELF']}" method="POST">\n
                    <h1>Ingresa las formas verbales correctas en inglés </h1>\n
                    <br>
                    <br>
                    <table>
                        {$table_body}
                    </table>
                    <br>
                    <button type="submit">Enviar</button>
                </form>\n
            HTML;
        } else {

            $respuestas = $_REQUEST["respuestas"];

            //declara variables para genear estadísticas
            $n_aciertos = 0;
            $p_aciertos = 0;
            $n_fallos = 0;
            $p_fallos = 0;
            $n_sin_respuesta = 0;
            $p_sin_respuesta = 0;

            $n_preguntas = count($arr_verbos, COUNT_RECURSIVE) - count($arr_verbos);

//            $n_preguntas = count($arr_verbos);

            $table_body = "";
            
            foreach($respuestas as $llave => $rpta) {
                $table_body .= "<tr>\n";
                $table_body .=      "<td> $llave </td>\n";
                $i = 0;
                foreach($rpta as $dato) {
                    if (empty($dato)) {
                        $n_sin_respuesta++; 
                        $table_body .=      "<td style='color: black; background-color: yellow;'>";
                    } else {
                        if ($dato == $arr_verbos[$llave][$i]) {
                            $n_aciertos++; 
                            $table_body .=      "<td style='color: white; background-color: green;'>";
                        } else {
                            $n_fallos++; 
                            $table_body .=      "<td style='color: white; background-color: red;'>";
                        }
                    }
                    $i++;
                    $table_body .=      " $dato </td>\n";

                }

                $table_body .= "</tr>\n";
            }

            //valores porcentuales a mostrar
            $p_aciertos = number_format($n_aciertos / $n_preguntas * 100, 2, '.', ''); 
            $p_fallos = number_format($n_fallos / $n_preguntas * 100, 2, '.', ''); 
            $p_sin_respuesta = number_format($n_sin_respuesta / $n_preguntas * 100, 2, '.', ''); 

            $mi_Heredoc = "";

            $mi_Heredoc = <<<HTML
                <form>
                    <h1>Ingresa las formas verbales correctas en inglés </h1>
                    <br>
                    <table>
                        <thead>
                            <tr>
                                <td>Verbo en español</td>
                                <td>Infinitivo</td>
                                <td>Pasado simple</td>
                                <td>Participio pasado</td>
                            </tr>
                        </head>
                        <tbody>
                            $table_body
                        </tbody>
                    </table>
                    <br>
                    <H1>Resultados</H1>
                    <br>
                    <table>
                        <thead>
                            <tr>
                                <td style="background-color: green; color: white;">Aciertos</td>
                                <td style="background-color: green; color: white;">%</td>
                                <td style="background-color: red; color: white;">Fallos</td>
                                <td style="background-color: red; color: white;">%</td>
                                <td style="background-color: yellow;">Sin respuesta</td>
                                <td style="background-color: yellow;">%</td>
                                <td style="background-color: blue; color: white;">TOTAL PREGUNTAS</td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="background-color: green; color: white;">{$n_aciertos}</td>
                                <td style="background-color: green; color: white;">{$p_aciertos}</td>
                                <td style="background-color: red; color: white;">{$n_fallos}</td>
                                <td style="background-color: red; color: white;">{$p_fallos}</td>
                                <td style="background-color: yellow;">{$n_sin_respuesta}</td>
                                <td style="background-color: yellow;">{$p_sin_respuesta}</td>
                                <td style="background-color: blue; color: white;">{$n_preguntas}</td>
                            </tr>
                        </tbody>
                    </table>
                </form>\n
            HTML;
/*





*/

//                    $mi_Heredoc = "Ejecutado";
        }

        echo $mi_Heredoc;
//        echo "Ejecutado"; 
    ?>
</body>
</html>
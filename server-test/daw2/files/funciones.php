<?php
    function recorreArreglo(array $verbos) {
        $lineas = "";
        foreach($verbos as $llave) {
            $lineas .= "<tr>\n"
                        . "<td style='text-align: center;' ><U>$llave</u></td>\n";

            for ($i = 1; $i <= 3; $i++) {
                $lineas .= "<td>\n"
//                            . "<input type='text' class='input-verbo' name='respuestas[$llave][]' />\n"
                            . "<input type='text' name='respuestas[$llave][]' />\n"
                        . "</td>\n";
            }

            $lineas .= "</tr>\n";

        }

        return $lineas;
    }

    function recorreArregloParcial(array $verbos, $contador) {
        $lineas = "";
        $cuenta = 1;
        foreach($verbos as $llave) {
            if ($cuenta > $contador) {
                break;
            } else {
                if ($cuenta == $contador) {
                    $lineas .= "<tr>\n"
                                . "<td style='text-align: center;' ><U>$llave</u></td>\n";

                    for ($i = 1; $i <= 3; $i++) {
                        $lineas .= "<td>\n"
                                    . "<input type='text' name='respuestas[$llave][]' />\n"
                                . "</td>\n";
                    }

                    $lineas .= "</tr>\n";
                }

            }

            $cuenta++;
        }

        return $lineas;
    }

    function recorreArregloRespuestas(array $verbos, array $respuestas) {
        $lineas = "";

        foreach($respuestas as $llave => $rpta) {
            $lineas .= "<tr>\n";
            $lineas .=      "<td> $llave </td>\n";
            $i = 0;
            foreach($rpta as $dato) {
                if (empty($dato)) {
                    $n_sin_respuesta++; 
                    $lineas .=      "<td style='background-color: yellow;'>";
                } else {
                    if ($dato == $arr_verbos[$llave][$i]) {
                        $n_aciertos++; 
                        $lineas .=      "<td style='color: white; background-color: green;'>";
                    } else {
                        $n_fallos++; 
                        $lineas .=      "<td style='color: white; background-color: red;'>";
                    }
                }
                $i++;
                $lineas .=      " $dato </td>\n";

            }

            $lineas .= "</tr>\n";
        }

        return $lineas;
    }
?>
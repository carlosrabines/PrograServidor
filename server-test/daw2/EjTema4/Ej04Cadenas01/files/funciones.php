<?php

    function devuelve_posiciones_recursiva($s_aguja, $s_pajar, $n_posant, $arr_result) {
        $s_nuevoPajar = $s_pajar;
        $n_posicion = $n_posant + cuenta_ocurrencias($s_aguja, $s_nuevoPajar);
        if ($n_posicion != 0) {
            return;
        } else {
            array_push($arr_result, $nposicion);
            $s_nuevoPajar = substr_replace($s_nuevoPajar,"",$n_posicion,strlen($s_aguja));
            $array_nuevo = devuelve_posiciones_recursiva($s_aguja, $s_nuevoPajar, $n_posicion, $arr_result);
            return $arr_result;
        }
    }


    function cuenta_ocurrencias($s_aguja, $s_pajar) {
        $n_cuenta = -1;
        if (strlen($s_aguja) <= strlen($s_pajar)) {
            $n_cuenta = substr_count($s_pajar, $s_aguja);
        }

        return $n_cuenta;
    }

    function devuelve_posiciones($s_aguja, $s_pajar) {
        $s_nuevoPajar = $s_pajar;
        $arr_posiciones = [];
        $ncuenta = cuenta_ocurrencias($s_aguja, $s_nuevoPajar);
        if ($ncuenta > 0) {
            $acc_posiciones = 1;
            $cuenta = 0;
            while ($ncuenta > 0) {
                //guarda posicion donde encontro "aguja" e "nuevopajar" y la agrega al array
                $nposicion = strpos($s_nuevoPajar, $s_aguja);
                if ($cuenta == 0) {
                    $acc_posiciones = $nposicion + 1;
                } else {
                    $acc_posiciones = $nposicion + 1 + (strlen($s_aguja) * $cuenta);
                }
                array_push($arr_posiciones, $acc_posiciones);

                //Rerita la primera ocurrencia "aguja" de "nuevopajar"
                $s_nuevoPajar = substr_replace($s_nuevoPajar,"",$nposicion,strlen($s_aguja));
    //            $s_nuevoPajar = str_replace($s_aguja,"",$s_nuevoPajar);

                //Valida si e3xisten mas ocurrencias de "aguja" en "nuevopajar
                $ncuenta = cuenta_ocurrencias($s_aguja, $s_nuevoPajar);
                $cuenta++;
            }
            return $arr_posiciones;
        } else {
            return false;
        }

    }    

    function pantalla_inicio() {

        $html = "<h1>Credenciales de Acceso</h1>"
        ."<form action='{$_SERVER['PHP_SELF']}' method='POST' >\n"
            ."<table>\n"
                ."<tr>\n"
                    ."<td><label for='id_usr'> Cadena aguja: </label><input type='text' id='id_aguja' name='s_aguja' required /></td>\n"
                    ."<td><label for='id_pwd'> Cadena pajar: </label><input type='text' id='id_pajar' name='s_pajar' required /></td>\n"
                    ."<td><button type='submit' value='Encontrar Ocurrencias' >Enviar</button>\n"
              . "</tr>\n"
              . "</table>\n";
        $html .= "</form>\n";

        return $html;
    }

    function pantalla_SegundaLLamada($s_aguja, $s_pajar) {
        
        $n_veces = 0;
        $html = "<h1>Credenciales de Acceso</h1>"
        ."<form action='{$_SERVER['PHP_SELF']}' method='POST' >\n"
            ."<table>\n"
                ."<tr>\n"
                    ."<td><label for='id_usr'> Cadena aguja: </label><input type='text' id='id_aguja' name='s_aguja' required /></td>\n"
                    ."<td><label for='id_pwd'> Cadena pajar: </label><input type='text' id='id_pajar' name='s_pajar' required /></td>\n"
                    ."<td><button type='submit' value='Encontrar Ocurrencias' >Enviar</button>\n"
              . "</tr>\n"
              . "</table>\n"
              . "<p>La cadena aguja aparece [ $n_veces ] en la cadena pajar</p>";

        $html .= "</form>\n";

        return $html;
    }

?>
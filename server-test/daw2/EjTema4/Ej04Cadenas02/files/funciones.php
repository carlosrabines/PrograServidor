<?php

    function fcadena_Upper_Case($s_izquierda, $s_centro, $t_centro) {
        $cad_result = (empty($s_izquierda) ? "" : "<p>Texto izquierda: " . strtoupper($s_izquierda) . "</p>"); 
        $cad_result .= "<p>Texto central inferior: " . strtoupper($s_centro) . "</p>"
                    ."<p>Texto central inferior: " . strtoupper($t_centro) . "</p>"; 

        return $cad_result;
    }

    function fcadena_Lower_Case($s_izquierda, $s_centro, $t_centro) {
        $cad_result = (empty($s_izquierda) ? "" : "<p>Texto izquierda: " . strtolower($s_izquierda) . "</p>"); 
        $cad_result .= "<p>Texto central inferior: " . strtolower($s_centro) . "</p>"
                    ."<p>Texto central inferior: " . strtolower($t_centro) . "</p>"; 

        return $cad_result;
    }

    function fcadena_Count_Vowels($s_izquierda, $s_centro, $t_centro) {

        $vocales = ["a" ,"e", "i", "o", "u", "á", "é", "í", "ó", "ú"];
        $n_acc_iz = 0;
        $n_acc_centro_sup = 0;
        $n_acc_centro_inf = 0;
        foreach($vocales as $vocal) {
            if (!empty($s_izquierda)) {
                $n_acc_iz += (substr_count($s_izquierda,$vocal) ? substr_count($s_izquierda,$vocal) : 0);
            }
            $n_acc_centro_sup += (substr_count($s_centro,$vocal) ? substr_count($s_centro,$vocal) : 0);
            $n_acc_centro_inf += (substr_count($t_centro,$vocal) ? substr_count($t_centro,$vocal) : 0);
        }

        $cad_result = (empty($s_izquierda) ? "" : "<p>Texto izquierda tiene : [" . $n_acc_iz . "] vocales</p>"); 
        $cad_result .= "<p>Texto central inferior tiene : [" . $n_acc_centro_sup . "] vocales</p>"
                    ."<p>Texto central inferior: " . $n_acc_centro_inf . "] vocales</p>"; 

        return $cad_result;
    }

    function fcadena_Count_Words($s_izquierda, $s_centro, $t_centro) {
        $cad_result = (empty($s_izquierda) ? "" : "<p>Cantidad de Palabras en [Texto izquierda]: " . str_word_count($s_izquierda,0) . "</p>"); 
        $cad_result .= "<p>Cantidad de Palabras en [Texto derecha(superior)]: " . str_word_count($s_centro,0) . "</p>"
                    ."<p>Cantidad de Palabras en [Texto derecha(inferior)]: " . str_word_count($t_centro,0) . "</p>"; 

        return $cad_result;
    }

    function fcadena_Replace($s_izquierda, $s_centro, $t_centro) {
        $cad_result = "<p>" . str_replace($s_centro, $s_izquierda, $t_centro) . "</p>"; 

        return $cad_result;
    }

    function fcadena_Remove($s_izquierda, $s_centro, $t_centro) {
        $cad_result = "<p>" . str_replace($s_centro, "", $t_centro) . "</p>"; 

        return $cad_result;
    }

    function fcadena_Remark($s_izquierda, $s_centro, $t_centro) {

        $remplazar = "<mark>" . $s_centro . "</mark>";
        $cad_result = "<p>" . str_replace($s_centro, $remplazar, $t_centro) . "</p>"; 

        return $cad_result;
    }

    function cadena_resultado($accion, $s_izquierda, $s_centro, $t_centro) {

        switch ($accion) {
            case 'Upper_Case':
            case 'Lower_Case':
            case 'Count_Vowels':
            case 'Count_Words':
            case 'Replace':
            case 'Remove':
            case 'Remark':
                $nombre_funcion = "fcadena_" . $accion; 
                $cadena = $nombre_funcion($s_izquierda, $s_centro, $t_centro);
                break; // Detiene la ejecución del switch
            default:
                $cadena = "";
                break;
        }        

        return $cadena;
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
    
    function pantalla_inicio($accion, $s_izquierda, $s_centro, $t_centro) {

        $parrafo_result = cadena_resultado($accion, $s_izquierda, $s_centro, $t_centro);

//        echo $t_centro;

        $html = "<h1>Funciones de Cadena" . (empty($accion) ? "" : " - " . $accion)  . "</h1>"
        ."<form action='{$_SERVER['PHP_SELF']}' method='POST' >\n"
            ."<div class='contenedor'>\n"
                ."<div class='columna-izquierda'>\n"
                    ."<button type='submit' class='botones-izquierda' name='accion' value='Remark'>Remark</button>\n"
                    ."<button type='submit' class='botones-izquierda' name='accion' value='Remove'>Remove</button>\n"
                    ."<button type='submit' class='botones-izquierda' name='accion' value='Replace'>Replace</button>\n"
                    ."<input type='text' class='texto-izquierda' name='s_izquierda' value='" . htmlspecialchars($s_izquierda) . "' /><br>\n"
                    ."<button type='submit' class='botones-izquierda' name='accion' value='Count_Words'>Count Words</button>\n"
                    ."<button type='submit' class='botones-izquierda' name='accion' value='Count_Vowels' >Count Vowels</button>\n"
                    ."<button type='submit' class='botones-izquierda' name='accion' value='Lower_Case'>Lower Case</button>\n"
                    ."<button type='submit' class='botones-izquierda' name='accion' value='Upper_Case' >Upper Case</button>\n"
                ."</div>\n"
                ."<div class='columna-centro'>\n"
                    ."<input type='text' class='texto-centro' name='s_centro' value='" . htmlspecialchars($s_centro) . "' required /><br>\n"
                    ."<textarea class='textarea-grande' name='t_centro' placeholder='Área de texto 2...' required >" . htmlspecialchars($t_centro) . "</textarea>\n"
                    .$parrafo_result
                ."</div>\n"
                ."<div class='columna-derecha'>\n"
                    ."<button type='submit' class='botones-derecha' value='Refresh'>Refresh</button>\n"
                ."</div>\n"
            ."</div>\n";

        $html .= "</form>\n";

        return $html;
    }

    function pantalla_SegundaLLamada($s_aguja, $s_pajar) {

        $n_veces = 0;
        $html = "<h1>Funciones de Cadena</h1>"
        ."<form action='{$_SERVER['PHP_SELF']}' method='POST' >\n"
            ."<div class='contenedor'>\n"
                ."<div class='columna-izquierda'>\n"
                    ."<button type='submit' value='Remark'>Remark</button>\n"
                    ."<button type='submit' value='Remove'>Remove</button>\n"
                    ."<p>"
                        ."<button type='submit' value='Replace'>Replace</button><br>\n"
                        ."<input type='text' class='texto-izquierda' value='s_replace' />\n"
                    ."</p>"
                    ."<button type='submit' value='Count_Words'>Count Words</button>\n"
                    ."<button type='submit' value='Count_Vowels' >Count Vowels</button>\n"
                    ."<button type='submit' value='Lower_Case'>Lower Case</button>\n"
                    ."<button type='submit' value='Upper_Case' >Upper Case</button>\n"
                ."</div>\n"
                ."<div class='columna-centro'>\n"
                ."</div>\n"
                ."<div class='columna-derecha'>\n"
                    ."<button type='submit' value='Refresh'>Refresh</button>\n"
                ."</div>\n"
            ."</div>\n";

/*
            ."<tr>\n"
                    ."<td><label for='id_usr'> Cadena aguja: </label><input type='text' id='id_aguja' name='s_aguja' required /></td>\n"
                    ."<td><label for='id_pwd'> Cadena pajar: </label><input type='text' id='id_pajar' name='s_pajar' required /></td>\n"
                    ."<td><button type='submit' value='Encontrar Ocurrencias' >Enviar</button>\n"
              . "</tr>\n"
              . "</table>\n"
              . "<p>La cadena aguja aparece [ $n_veces ] en la cadena pajar</p>";
*/

        $html .= "</form>\n";
        return $html;
    }

    function pantalla_MuestraPosicionesPantalla($s_aguja, $s_pajar) {

        $arr_resultado = devuelve_posiciones($s_aguja, $s_pajar);

        if (!$arr_resultado) {
            $html = "Ejecutado, listo  para mostrar resultados: << NO HAY POSICIONESD A MOSTRAR >>";
        } else {
            if (count($arr_resultado) > 0) {
                $html = "Ejecutado, listo  para mostrar resultados - posicionesa: ";
                foreach ($arr_resultado as $result) {
                    $html .= "<br>";
                    $html .= " - " . $result;
                }
            } else {
                $html = "Ejecutado, listo  para mostrar resultados: << NO HAY POSICIONESD A MOSTRAR >>";
            }
        }

    }

?>
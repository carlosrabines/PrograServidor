<?php

    function selecciona_baraja($palo, $cantidad, $orden) {
        // Obtiene todos los archivos .jpg de la carpeta

        $arr_baraja = glob("baraja_esp/*$palo.jpg");

        switch ($orden) {
            case "Ascendente":
                sort($arr_baraja);
                break;

            case "Descendente":
                rsort($arr_baraja);
                break;

            case "Barajada":
                shuffle($arr_baraja);
                break;
        }

        if ($cantidad < 12) {
            array_splice($arr_baraja, $cantidad);            
        }

        return $arr_baraja;

    }


    function mostrar_cartas($ncantidad, $s_palos, $orden) {
        $cadena_html = "<table>\n"
                        ."<tbody>\n";
                        
        $arr_bastos = $arr_copas = $arr_espadas = $arr_oros = []; 
        foreach($s_palos as $s_palo) {
            if ($s_palo == "bastos") {
                $arr_bastos = selecciona_baraja($s_palo, $ncantidad, $orden);
            }
            if ($s_palo == "copas") {
                $arr_copas = selecciona_baraja($s_palo, $ncantidad, $orden);
            }
            if ($s_palo == "espadas") {
                $arr_espadas = selecciona_baraja($s_palo, $ncantidad, $orden);
            }
            if ($s_palo == "oros") {
                $arr_oros = selecciona_baraja($s_palo, $ncantidad, $orden);
            }
        }

        $arr_newbaraja = array_merge($arr_bastos, $arr_copas, $arr_espadas, $arr_oros);                        

        if ($orden == "Barajada") {
            shuffle($arr_newbaraja);
        }

        $cadena_html .= "<tr>\n";
        $ncolumna = 1;
        foreach ($arr_newbaraja as $carta) {
            if ($ncolumna > 12) {
                $cadena_html .= "</tr>\n";
                $cadena_html .= "<tr>\n";
                $ncolumna = 1;
            }
            $cadena_html .= "<td>\n"
                            ."<img src='$carta' alt='Carta'>\n"        
                        ."</td>\n";
            $ncolumna++;
        }
        $cadena_html .= "</tr>\n";
        $cadena_html .= "</tbody>\n"
                    ."</table>\n";

        return $cadena_html;
    }


    function pantalla_inicio($accion, $cantidad, $selec_palos, $orden) {

        switch ($accion) {
            case 'Mostrar_cartas':
                $nombre_funcion = strtolower($accion); 
                $html_visualizar_cartas = $nombre_funcion($cantidad, $selec_palos, $orden);
                break;
            default:
                $html_visualizar_cartas = "";
                break;
        }            

        $bastos_checked = $copas_checked = $espadas_checked = $oros_checked = "";

        foreach($selec_palos as $spalo) {
            if ($spalo=="bastos") {
                $bastos_checked = "checked";
            }
            if ($spalo=="copas") {
                $copas_checked = "checked";
            }
            if ($spalo=="espadas") {
                $espadas_checked = "checked";
            }
            if ($spalo=="oros") {
                $oros_checked = "checked";
            }
        }

        $asce_checked = ($orden == "Ascendente") ? "checked" : "";
        $desc_checked = ($orden == "Descendente") ? "checked" : "";
        $bara_checked = ($orden == "Barajada") ? "checked" : "";

        $html = "<h1>Baraja" . (empty($accion) ? "" : " - " . $accion)  . "</h1>"
        ."<form action='{$_SERVER['PHP_SELF']}' method='POST' >\n"
            ."<div class='contenedor'>\n"
                ."<div class='columna-izquierda'>\n"
                    ."<fieldset class='checkbox-grupo'>\n"
                    ."<legend>Indica palo(s)</legend>\n"
                        ."<label><input class='checkbox-opcion' type='checkbox' name='palos[]' value='bastos' " . $bastos_checked . "/> Bastos</label><br>\n"
                        ."<label><input class='checkbox-opcion' type='checkbox' name='palos[]' value='copas' " . $copas_checked . "/> Copas</label><br>\n"
                        ."<label><input class='checkbox-opcion' type='checkbox' name='palos[]' value='espadas' " . $espadas_checked . "/> Espadas</label><br>\n"
                        ."<label><input class='checkbox-opcion' type='checkbox' name='palos[]' value='oros' " . $oros_checked . "/> Oros</label>\n"
                    ."</fieldset>\n"
                    ."<label for='id_cantidad'>Cantidad de cartas:</label><input type='number' id='id_cantidad' name='n_cantidad' value=$cantidad  min='1' max='12' required />\n"
                    ."<fieldset  class='radio-grupo'>\n"
                    ."<legend>Orden:</legend>\n"
                        ."<label class='radio-opcion' ><input type='radio' name='orden' value='Ascendente' required " . $asce_checked . "/> Ascendente</label><br>\n"
                        ."<label class='radio-opcion' ><input type='radio' name='orden' value='Descendente' required " . $desc_checked . "/> Descendente</label><br>\n"
                        ."<label class='radio-opcion' ><input type='radio' name='orden' value='Barajada' required " . $bara_checked . "/> Barajada</label>\n"
                    ."</fieldset>\n"
                    ."<button type='submit' class='botones-izquierda' name='accion' value='Mostrar_cartas'>Mostrar cartas</button>\n"
//                    ."<button type='submit' class='botones-izquierda' name='accion' value='Barajar_cartas'>Barajar cartas</button>\n"
                    ."<button type='submit' class='botones-derecha' value='Refresh'>Refresh</button>\n"
                ."</div>\n"
                ."<div class='columna-centro'>\n"
                    .$html_visualizar_cartas
                ."</div>\n"
            ."</div>\n";

        $html .= "</form>\n";

        return $html;
    }

?>
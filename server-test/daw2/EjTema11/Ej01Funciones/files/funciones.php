<?php

    function generar_tabla($nfilas, $ncolumnas) {
        $cadena_html = "<table>\n"
                        ."<tbody>\n";
        for ($i = 1; $i <= $nfilas; $i++) {
            $cadena_html .= "<tr>\n";
            for ($j = 1; $j <= $ncolumnas; $j++) {
                $cadena_html .= "<td>Fila {$i} Columna {$j}</td>\n";
            }
            $cadena_html .= "</tr>\n";
        }
        $cadena_html .= "</tbody>\n"
                    ."</table>\n";

        return $cadena_html;
    }


    function pantalla_inicio($accion, $nfilas, $ncolumnas) {

//                $nombre_funcion = strtolower($accion); 
                $html_visualizar_tabla = generar_tabla($nfilas, $ncolumnas);
/*    
        switch ($accion) {
            case 'generar_tabla':
                $nombre_funcion = strtolower($accion); 
                $html_visualizar_tabla = $nombre_funcion($nfilas, $ncolumnas);
                break;
            default:
                $html_visualizar_tabla = "";
                break;
        }            
*/
        $html = "<h1>Mostrar tablas</h1>"
        ."<form action='{$_SERVER['PHP_SELF']}' method='POST' >\n"
            ."<div class='contenedor'>\n"
                ."<div class='columna-izquierda'>\n"
                    ."<label for='id_filas'>Filas:</label>"
                    ."<input type='number' id='id_filas' name='n_filas' value=$nfilas  min='1' max='20' required />\n"
                    ."<label for='id_columnas'>Columnas:</label>"
                    ."<input type='number' id='id_columnas' name='n_columnas' value=$ncolumnas  min='1' max='12' required />\n"
                    ."<button type='submit' class='botones-izquierda' name='accion' value='Generar_Tabla'>Generar Tabla</button>\n"
                ."</div>\n"
                ."<div class='columna-centro'>\n"
                    .$html_visualizar_tabla
                ."</div>\n"
            ."</div>\n";

        $html .= "</form>\n";

        return $html;
    }

?>
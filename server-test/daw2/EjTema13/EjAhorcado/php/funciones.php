<?php

    function validaciones() {
        session_start();

        $accion = $_REQUEST["accion"] ?? "";
        if (empty($accion)) {
            $accion = "Mostrar_letras";
            $_SESSION['cuenta_fallas'] = 1;
        }

        if ($accion == "Refresh") {
            session_unset();
            session_destroy();
            session_start();
            $accion = "Mostrar_letras";
            $_SESSION['cuenta_fallas'] = 1;
        }

        if (!isset($_SESSION['palabras_ahorcado'])) {
            $_SESSION['palabras_ahorcado'] = [
                'MURCIELAGO',
                'OTORRINOLARINGOLO',
                'PARALELEPIPEDO',
                'CALEIDOSCOPIO',
                'IDIOSINCRACIA',
                'EXEQUIAS',
                'ESTERNOCLEIDOMASTOIDEO',
                'DESOXIRRIBONUCLEICO',
                'FEHACIENTE',
                'ESCABULLIRSE'
            ];
        }

        if (!isset($_SESSION['letra_fallos'])) {
            $_SESSION['letra_fallos'] = 1;
        }

        $letra_fallos = $_SESSION['letra_fallos'];

        $palabras_ahorcado = $_SESSION['palabras_ahorcado'];
        if (!isset($_SESSION['palabra_ahorcado'])) {
            $indiceAleatorio = array_rand($palabras_ahorcado);
            $_SESSION['palabra_ahorcado'] = $palabras_ahorcado[$indiceAleatorio];
        }
        $palabra_ahorcado = $_SESSION['palabra_ahorcado'];

        if (!isset($_SESSION['letras_seleccionadas'])) {
            $_SESSION['letras_seleccionadas'] = [];
        }

        $html_alert = "<img src='img/Ahorcado01.png' alt='Ahorcado'><br>\n";

        if (isset($_REQUEST['letra'])) {
            $letra_seleccionada = $_REQUEST['letra'];
            if (!in_array($letra_seleccionada, $_SESSION['letras_seleccionadas'])) {
                $_SESSION['letras_seleccionadas'][] = $letra_seleccionada;
            }

            if (!str_contains($palabra_ahorcado, $letra_seleccionada)) {
                $letra_fallos++;
                $_SESSION['letra_fallos'] = $letra_fallos;
            }
            $letra_fallos = $_SESSION['letra_fallos'];
            $dibujo = "img/Ahorcado0" . $letra_fallos . ".png";
            $html_alert = "<img src='" . $dibujo . "' alt='Ahorcado'><br>\n";
        }

        return [
            'accion' => $accion,
            'palabra_ahorcado' => $palabra_ahorcado,
            'letras_seleccionadas' => $_SESSION['letras_seleccionadas'],
            'html_alert' => $html_alert,
            'letra_fallos' => $letra_fallos
        ];
    }

    function mostrar_palabra($palabra_ahorcado, $letras_seleccionadas, &$falta_acertar) {
        $cadena_html = "<table>\n"
                        ."<caption>Palabra a descifrar</caption>\n"
                        ."<tbody>\n"
                        ."<tbody>\n";

        $cadena_html .= "<tr>\n";
        $ncolumna = 1;
        $palabra_ahorcado = mb_str_split($palabra_ahorcado);
        $falta_acertar = 0;
        foreach($palabra_ahorcado as $letra) {
            if ($ncolumna > 10) {
                $cadena_html .= "</tr>\n";
                $cadena_html .= "<tr>\n";
                $ncolumna = 1;
            }
            if (in_array($letra, $letras_seleccionadas)) {
                $cadena_html .= "<td>$letra</td>\n";
            } else {
                $falta_acertar++;
                $cadena_html .= "<td>_</td>\n";
            }
            $ncolumna++;
        }
        $cadena_html .= "</tr>\n";
        $cadena_html .= "</tbody>\n"
                    ."</table>\n";

        return $cadena_html;

    }


    function letras_seleccionadas($letras_seleccionadas, $letra_fallos, $falta_acertar) {

        $cadena_html = "<table>\n"
                        ."<caption>Letras seleccionadas</caption>\n"
                        ."<tbody>\n"
                        ."<tbody>\n";

        $cadena_html .= "<tr>\n";
        $ncolumna = 1;
        foreach($letras_seleccionadas as $letra) {
            if ($ncolumna > 10) {
                $cadena_html .= "</tr>\n";
                $cadena_html .= "<tr>\n";
                $ncolumna = 1;
            }
            $cadena_html .= "<td>$letra</td>\n";
            $ncolumna++;
        }
        $cadena_html .= "</tr>\n";
        $cadena_html .= "</tbody>\n"
                    ."</table><br><br>\n";

        $cadena_html .= "<p>Cantidad de fallos: " . ($letra_fallos-1) . "</p>\n";

        if ($letra_fallos > 6 ) {
            $cadena_html .= "<br><br><h2style='color: red;'>JUEGO FINALIZADO !!!</h2style=>\n";
            $cadena_html .= "<br><h2style='color: red;'>USTED HA PERDIDO !!!</h2style=>\n";
        }
        if ($falta_acertar == 0) {
            $cadena_html .= "<br><br><h2 style='color: green;'>JUEGO FINALIZADO !!!</h2>\n";
            $cadena_html .= "<br><h2 style='color: green;'>USTED HA GANADO !!!</h2>\n";
        }

        return $cadena_html;
    }

    function mostrar_letras($letras_seleccionadas, $letra_fallos, $falta_acertar) {

        $abcdario = mb_str_split('ABCDEFGHIJKLMNÑOPQRSTUVWXYZ');
        $abc_restante = array_diff($abcdario, $letras_seleccionadas);

        $cadena_html = "<table>\n"
                        ."<caption>Letras para seleccionar</caption>\n"
                        ."<tbody>\n"
                        ."<tbody>\n";
                        
        $cadena_html .= "<tr>\n";
        $ncolumna = 1;
        foreach($abc_restante as $letra) {
            if ($ncolumna > 10) {
                $cadena_html .= "</tr>\n";
                $cadena_html .= "<tr>\n";
                $ncolumna = 1;
            }
            $cadena_html .= "<td>\n";
            if ($letra_fallos >6) {
                $cadena_html .= "<a>$letra</a>\n";
            } else {
                $cadena_html .= "<a href='index.php?letra=$letra'>$letra</a>\n";
            }
            $cadena_html .= "</td>\n";
            $ncolumna++;
        }
        $cadena_html .= "</tr>\n";
        $cadena_html .= "</tbody>\n"
                    ."</table>\n";

        return $cadena_html;
    }


    function pantalla_inicio($accion, $letras_seleccionadas, $html_palabra_mostrar, $html_alert, $letra_fallos, $falta_acertar) {

        $html_visualizar_letras_seleccionar = mostrar_letras($letras_seleccionadas, $letra_fallos, $falta_acertar);
        if (count($letras_seleccionadas) == 0) {
            $letras_seleccionadas = [];
            $html_visualizar_letras_seleccionadas = "";
        } else {
            $html_visualizar_letras_seleccionadas = letras_seleccionadas($letras_seleccionadas, $letra_fallos, $falta_acertar);
       }

        $html = "<h1>Juego del ahorcado</h1>"
        ."<form action='{$_SERVER['PHP_SELF']}' method='POST' >\n"
            ."<div class='contenedor'>\n"
                ."<div class='columna-izquierda'>\n"
//                    ."<button type='submit' class='botones-izquierda' name='accion' value='Mostrar_letras'>Mostrar letras</button>\n"
                    ."<button type='submit' class='botones-derecha' name='accion' value='Refresh'>Refresh</button>\n"
                ."</div>\n"
                ."<div class='columna-centro'>\n"
                    .$html_visualizar_letras_seleccionar
                ."</div>\n"
                ."<div class='columna-centro2'>\n"
                    .$html_visualizar_letras_seleccionadas
                ."</div>\n"
                ."<div class='columna-derecha'>\n"
                    .$html_palabra_mostrar
                ."</div>\n"
                ."<div class='columna-derecha2'>\n"
                    .$html_alert
                ."</div>\n"
            ."</div>\n";

        $html .= "</form>\n";

        return $html;
    }

?>
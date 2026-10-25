<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mes calendario</title>
    <link rel="stylesheet" href="../styles/styles_mes.css">
</head>
<body>
    <?php

        if (!isset($_REQUEST["n_anio"]) || !isset($_REQUEST["n_mes"])) {
            header("Location: 20260923_meses_calendario_formulario.html");
            exit; 
        }

        $n_anio = $_REQUEST["n_anio"];
        $n_mes = $_REQUEST["n_mes"];

        $a_mes = [
                   1 => "Enero", 2 => "Febrero", 3 => "Marzo", 4 => "Abril", 5 => "Mayo", 6 => "Junio",
                   7 => "Julio", 8 => "Agosto", 9 => "Septiembre", 10 => "Octubre", 11 => "Noviembre", 12 => "Diciembre"
                 ];

        $a_semana = ["L", "M", "X","J","V","S","D"];

//        $n_anio = 1900;
//        $n_mes = 2;

        $html = "";
        $cierre_div = true;

        $fila_mes = 4;
        $cant_meses = 1;

        for ($w = 1; $w <= $n_mes; $w++) {
        
            $s_mes = $a_mes[$w];
            $fecha_primer_dia = new DateTime("$n_anio-$w-01");
            $fecha_ultimo_dia = new DateTime($fecha_primer_dia->format('Y-m-t'));
            $dia_de_semana = $fecha_primer_dia->format('N');

            //Cabecera del mes calendario
            $table_head = "";
            $table_body = "";
            $table_head = "";

            for ($i = 0; $i < count($a_semana); $i++) {
                $table_head .= "<th>" . ($a_semana[$i]) . " </th>";
            }

            //Cuerpo del mes calendario
            $table_body = "";

            //para recorrer hasta el ultimo día del mes
            $inicia_calendario = false;

            $i = 1; //para recorrer todos los días del mes
            $j = 1; //para empezar desde el dia de la semana que corresponde

            $table_body .= "<tr>\n";

            $n_ultimodia = $fecha_ultimo_dia->format('d');

            for ($j = 1; $j <= 7 && $i <= $n_ultimodia ; $j++) {

                if ($j < $dia_de_semana && !$inicia_calendario) {
                    $table_body .= "<td></td>";
                } else {
                    $inicia_calendario = true;
                    if ($j == 7) {
                        $table_body .= "<td class = 'tabla-mes-domingo'>" . ($i) . " </td>";
                        $table_body .= "</tr>\n";
                        $table_body .= "<tr>\n";
                        $j = $j - 7;
                    } else {
                        $table_body .= "<td>" . ($i) . " </td>";
                    }
                    $i++;
                }
            }

            $table_body .= "</tr>\n";


            if ($cant_meses <= $fila_mes ) {
                if ($cant_meses == 1 ) {
                    $html .= "<div class = 'contenedor-horizontal'>\n";
                    $cierre_div = false;
                }
                $cant_meses += 1;
            }

 
            $html .= "<div class='caja'>\n";
            $html .=     "<table>\n"; 
            $html .=         "<caption><u><strong>Mes : " . $s_mes . "</strong></u></caption>\n";
            $html .=         "<thead>\n";
            $html .=             "<tr>\n";
            $html .=                 $table_head;
            $html .=             "</tr>\n";
            $html .=         "</thead>\n";
            $html .=         "<tbody>\n";
            $html .=             "<tr>\n";
            $html .=                 $table_body;
            $html .=             "</tr>\n";
            $html .=         "</tbody>\n";
            $html .=     "</table>\n";
            $html .= "</div>\n";

            if ($cant_meses > $fila_mes ) {
                $cant_meses = 1;
                $html .= "</div>\n";
            }

        }

        if ($cant_meses <= $fila_mes ) {
            $html .= "</div>\n";
        }
        
        $mi_Heredoc = <<<HTML
                    {$html}
                HTML;

        echo $mi_Heredoc;

    ?>
</body>
</html>
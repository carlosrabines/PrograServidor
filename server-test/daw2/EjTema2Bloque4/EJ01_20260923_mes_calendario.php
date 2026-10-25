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

            $mi_Heredoc = <<<HTML
                    <h1>Solicita Año-Mes Calendario</h1>\n
                        <form action="{$_SERVER['PHP_SELF']}" method="POST">\n
                            <label for="id_n_anio"> Año [entre 1900 y 2030]: </label>\n
                            <input
                                type="number"
                                id_numero="id_n_anio"
                                name="n_anio"
                                min="1900"
                                max="2030"
                                required
                            />\n
                            <label for="id_n_mes"> Mes [entre 1 y 12]: </label>\n
                            <input
                                type="number"
                                id_nmes="id_n_anio"
                                name="n_mes"
                                min="1"
                                max="12"
                                required
                            />\n
                            <button type="submit">Enviar</button>
                        </form>\n
                    HTML;

        } else {

            $n_anio = $_REQUEST["n_anio"];
            $n_mes = $_REQUEST["n_mes"];

            switch ($n_mes) {
                case 1:
                    $s_mes = "Enero";
                    break;
                case 2:
                    $s_mes = "Febrero";
                    break;
                case 3:
                    $s_mes = "Marzo";
                    break;
                case 4:
                    $s_mes = "Abril";
                    break;
                case 5:
                    $s_mes = "Mayo";
                    break;
                case 6:
                    $s_mes = "Junio";
                    break;
                case 7:
                    $s_mes = "Julio";
                    break;
                case 8:
                    $s_mes = "Agosto";
                    break;
                case 9:
                    $s_mes = "Setiembre";
                    break;
                case 10:
                    $s_mes = "Octubre";
                    break;
                case 11:
                    $s_mes = "Noviembre";
                    break;
                case 12:
                    $s_mes = "Diciembre";
                    break;
            }

    /*        $a_mes = [
                    1 => "Enero", 2 => "Febrero", 3 => "Marzo", 4 => "Abril", 5 => "Mayo", 6 => "Junio",
                    7 => "Julio", 8 => "Agosto", 9 => "Septiembre", 10 => "Octubre", 11 => "Noviembre", 12 => "Diciembre"
                    ];

            $s_mes = $a_mes[$n_mes];
    */
            $a_semana = ["L", "M", "X","J","V","S","D"];

    
            $fecha_primer_dia = new DateTime("$n_anio-$n_mes-01");
            $fecha_ultimo_dia = new DateTime($fecha_primer_dia->format('Y-m-t'));
            $dia_de_semana = $fecha_primer_dia->format('N');


            //Cabecera del mes calendario
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

            $mi_Heredoc = <<<HTML
                    <div>
                        <table class = 'tabla-mes'>\n
                            <caption><u><strong>Mes : $s_mes </strong></u></caption>\n
                            <thead>\n
                                <tr>\n
                                    {$table_head}
                                </tr>\n
                            </thead>\n
                        <tbody>\n
                            <tr>\n
                                {$table_body}
                            </tr>\n
                        </tbody>\n
                        </table>\n
                    </div>
                    HTML;
        }

        echo $mi_Heredoc;

    ?>
</body>
</html>
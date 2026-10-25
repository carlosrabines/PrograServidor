<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tablas de multiplicar</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
    <?php
        $temperaturas=array();
        $temperaturas['Caja_1']=array(1,1,2,3,2,1,2,3,3,3,2,1,3,4);
        $temperaturas['Caja_2']=array(0,0,3,2,4,3,2,0,1,2,3,4,2,1);
        $temperaturas['Caja_3']=array(3,1,2,3,5,2,2,0,1,2,3,4,2,1);
        $temperaturas['Caja_4']=array(2,2,2,3,5,2,3,2,0,1,2,3,0,1);
        $temperaturas['Caja_5']=array(0,3,2,3,5,2,3,2,0,1,2,3,0,1);

        $temp_max = 4;

        //Para saber cuantas coolumnas tiene la tabla
        $col = count($temperaturas['Caja_1']);

        echo <<<HTML
                <table class='Nuevo'>\n
                    <caption><u><strong>TEMPERATURA DE LAS CAJAS (EDOC):</strong></u></caption>\n
                    <thead>\n
                        <tr>\n
                            <th>Nro. Caja</th>\n
                HTML;
                    for ($i = 0; $i < $col; $i++) {
                        echo "<th>Temp." . ($i + 1) . " </th>\n";
                    }
        echo <<<HTML
                        </tr>\n
                    </thead>\n

                <tbody>\n
                HTML;
                foreach ($temperaturas as $caja => $listado_temperaturas) {
                    echo <<<HTML
                            <tr>\n
                                <td>
                                    $caja 
                                </td>
                            HTML;
                        foreach ($listado_temperaturas as $temp) {
                            $celda = ($temp > $temp_max) ? "<td style='background-color: red; color:white'>" : "<td>";
                            echo $celda;
                            echo $temp . " ";
                            echo "</td>";
                        }
                    echo "</tr>\n";
                }
        echo <<<HTML
                </tbody>\n
                </table>
                HTML;

    ?>
</body>
</html>
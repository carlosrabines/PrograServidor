<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tablas de multiplicar</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
    <?php

        define('TABLA_MAX', 12);

        function tabla_de_multiplicar($tabla_max) {

            if ($tabla_max > 12) {
                $tabla_max = 12;
            }

            echo "<thead>\n";
                echo "<tr>\n";
                    for ($i = 1; $i <= $tabla_max; $i++) {
                        echo "<th><u><strong>Tabla del " . $i . "</strong></u></th>\n";
                    }
                echo "</tr>";
            echo "</thead>\n";
            
            echo "<tbody>\n";
            for ($j = 1; $j <= 12; $j++) {
                echo "<tr>\n";
                for ($i = 1; $i <= $tabla_max; $i++) {
                    echo "<td>";
                    echo $j . " x " . $i . " = " . $j * $i;
                    echo "</td>";
                }
                echo "</tr>\n";
            }
            echo "</tbody>\n";
        }

        echo "<table>\n";
            echo "<caption><u><strong>TABLAS DE MULTIPLICAR</strong></u></caption>\n";
            tabla_de_multiplicar(TABLA_MAX);

        echo "</table>"
    ?>
</body>
</html>

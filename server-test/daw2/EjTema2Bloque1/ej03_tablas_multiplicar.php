<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Tablas de multiplicar</title>
    <link rel="stylesheet" href="../styles/styles.css">
</head>
<body>
    <?php

        echo "<u><strong>SELECIONE CUANTAS TABLAS DE MULTILICAR GENERAR</strong></u>\n";
        echo "<table>\n";

            echo "<tbody>\n";
                for ($i = 1; $i <= 12; $i++) {
                    echo "<tr>\n";
                        echo "<td>";
    //                    echo "<a href='http://daw2627/EjTema2Bloque1/ej03_tablas_multiplicar_get.php?tabla=$i' > Tabla del " . $i . "</a>";
                        echo "<a href='ej03_tablas_multiplicar_get.php?tabla=$i' > Tabla del $i </a>";
                        /*
                        . $j . " x " . $i . " = " . $j * $i;
                        */
                        echo "</td>";
                    echo "</tr>\n";
                }
            echo "</tbody>\n";

        echo "</table>"
    ?>
</body>
</html>
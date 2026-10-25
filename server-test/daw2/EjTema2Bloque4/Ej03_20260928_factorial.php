<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factorial</title>
    <link rel="stylesheet" href="../styles/styles_mes.css">
</head>
<body>
    <?php

        if (!isset($_REQUEST["n_factorial"])) {
            $mi_Heredoc = <<<HTML

                    <h1>Calcular factorial de un número</h1>\n

                    <form action="{$_SERVER['PHP_SELF']}" method="post">\n
                        <label for="id_n_factorial"> Numero [min 2, max 15]: </label>\n
                        <input
                            type="number"
                            id_numero="id_n_factorial"
                            name="n_factorial"
                            min="2"
                            max="15"
                            required
                        />\n

                        <!--<br><br> -->
                        <button type="submit">Enviar</button>\n
                    </form>\n

                    HTML;

            echo $mi_Heredoc;

        } else {
            $n_factorial = $_REQUEST["n_factorial"];

            function calculaFactorial($n_factorial) {
                if ($n_factorial <=0) {
                    return 1;
                }
                return $n_factorial * calculaFactorial($n_factorial - 1);
            }

            $n_resultado=calculaFactorial($n_factorial);

            echo "El factorial de $n_factorial es: <u><strong> " . number_format($n_resultado, 2, ',', '.') . "</strong></u>";

        }



    ?>
</body>
</html>
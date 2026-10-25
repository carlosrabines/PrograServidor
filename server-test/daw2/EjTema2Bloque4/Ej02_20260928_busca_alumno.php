<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factorial</title>
    <link rel="stylesheet" href="../styles/styles_mes.css">
</head>
<body>
    <?php

        if (!isset($_REQUEST["n_expediente_alumno"])) {

            $mi_Heredoc = <<<HTML

                    <h1>Buscar alumno</h1>\n

                    <form action="{$_SERVER['PHP_SELF']}" method="post">
                        <label for="id_s_nombre_alumno"> Ingrese nombre del alumno: </label>\n
                        <input
                            type="number"
                            id_numero="id_n_expediente_alumno"
                            name="n_expediente_alumno"
                            min="1"
                            max="12"
                            required
                        />\n
                        <button type="submit">Enviar</button>\n
                    </form>\n

                    HTML;

            echo $mi_Heredoc;

       } else {
            $n_expediente_alumno = $_REQUEST["n_expediente_alumno"];

            $array_alumnos = [
                                    "1" => ["nombre" => "Carlos", "apellido" => "Rabines"],
                                    "2" => ["nombre" => "Arlie", "apellido" => "Rivas"],
                                    "3" => ["nombre" => "Javier", "apellido" => "Cajigal"],
                                    "4" => ["nombre" => "José", "apellido" => "Ramón"],
                                    "5" => ["nombre" => "Juan", "apellido" => "Perez"],
                                    "6" => ["nombre" => "Dylan", "apellido" => "Dylan"],
                                    "7" => ["nombre" => "Guillermo", "apellido" => "Guillermo"],
                                    "8" => ["nombre" => "Alejandro", "apellido" => "Seperuelo"],
                                    "9" => ["nombre" => "Carlos", "apellido" => "Rojas"],
                                    "10" => ["nombre" => "Miguel", "apellido" => "Miguel"],
                                    "11" => ["nombre" => "Ultimo", "apellido" => "Ultimo"]
                                ];
            if (array_key_exists($n_expediente_alumno, $array_alumnos)) {
                $nombre_alumno = $array_alumnos[$n_expediente_alumno]["nombre"];
                $apellido_alumno = $array_alumnos[$n_expediente_alumno]["apellido"];

                $s_resultado = "El expediente <u><strong>$n_expediente_alumno</u></strong> pertenece al alumno: <u><strong>$nombre_alumno - $apellido_alumno</u></strong>";

            } else {
                $s_resultado = "El expediente <u><strong>$n_expediente_alumno</u></strong> solicitado: <u><strong>no existe</strong></u>";
//                echo "El expediente no existe.";
            }

            echo $s_resultado;

        }


    ?>
</body>
</html>
<?php
require_once __DIR__ . '/MiCabecera.php';

$cabecera = new MiCabecera(
    'Segunda página',
    'Formulario de nombre y apellido'
);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Segunda página</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?= $cabecera ?>
    <main>
        <form action="index.php" method="POST">
            <p>
                <label for="id_nombre">Nombre:</label>
                <input type="text" id="id_nombre" name="s_nombre">
            </p>
            <p>
                <label for="id_apellido">Apellido:</label>
                <input type="text" id="id_apellido" name="s_apellido">
            </p>
            <button type="submit" class="botones" >Volver</button>
        </form>
    </main>
</body>
</html>
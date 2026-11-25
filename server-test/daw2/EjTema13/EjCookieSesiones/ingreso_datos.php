<?php
session_start();
require_once __DIR__ . '/files/funciones.php';

if (!usuario_autenticado()) {
    unset($_SESSION['cod_usuario']);
    setcookie('cod_usuario', '', time() - 3600, '/');
    unset($_COOKIE['cod_usuario']);
    header('Location: index.php');
    exit();
}

if (!isset($_SESSION['registro']) || !is_array($_SESSION['registro'])) {
    $_SESSION['registro'] = [];
}

$datos = [];
$errores = [];
$mensaje = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $datos = [
        'dni' => trim((string) ($_POST['n_dni'] ?? '')),
        'nombre' => trim((string) ($_POST['s_nombre'] ?? '')),
        'apellido' => trim((string) ($_POST['s_apellido'] ?? '')),
        'edad' => trim((string) ($_POST['n_edad'] ?? '')),
        'ciudad' => trim((string) ($_POST['s_ciudad'] ?? '')),
        'email' => trim((string) ($_POST['s_email'] ?? '')),
        'codpostal' => trim((string) ($_POST['s_codpostal'] ?? '')),
        'pais' => trim((string) ($_POST['s_pais'] ?? '')),
        'idiomas' => isset($_POST['idiomas']) && is_array($_POST['idiomas'])
            ? $_POST['idiomas']
            : [],
        'estudios' => isset($_POST['estudios']) && is_array($_POST['estudios'])
            ? $_POST['estudios']
            : [],
    ];

    $camposTexto = [
        'dni' => 'DNI',
        'nombre' => 'Nombre',
        'apellido' => 'Apellido',
        'edad' => 'Edad',
        'ciudad' => 'Ciudad',
        'email' => 'Correo',
        'codpostal' => 'Código postal',
        'pais' => 'País',
    ];

    foreach ($camposTexto as $campo => $etiqueta) {
        if ($datos[$campo] === '') {
            $errores[$campo] = "El campo {$etiqueta} no puede estar vacío";
        }
    }

    $dniNormalizado = strtoupper(str_replace([' ', '-'], '', $datos['dni']));
    if ($datos['dni'] !== '' && !dni_es_valido($datos['dni'])) {
        $errores['dni'] = 'El DNI no tiene el formato o la letra correctos';
    } elseif ($dniNormalizado !== '' && isset($_SESSION['registro'][$dniNormalizado])) {
        $errores['dni'] = 'El DNI ya está registrado';
    }

    if ($datos['edad'] !== '' && (!ctype_digit($datos['edad'])
        || (int) $datos['edad'] < 18
        || (int) $datos['edad'] > 120)) {
        $errores['edad'] = 'La edad debe estar entre 18 y 120';
    }

    if ($datos['email'] !== '' && !filter_var($datos['email'], FILTER_VALIDATE_EMAIL)) {
        $errores['email'] = 'El correo electrónico no es válido';
    }

    if ($datos['ciudad'] !== '' && !ciudad_europea($datos['ciudad'])) {
        $errores['ciudad'] = 'La ciudad debe pertenecer a Europa';
    }

    if ($datos['idiomas'] === []) {
        $errores['idiomas'] = 'Debe seleccionar al menos un idioma';
    }

    if ($datos['estudios'] === []) {
        $errores['estudios'] = 'Debe seleccionar al menos un estudio';
    }

    if ($errores === []) {
        $_SESSION['registro'][$dniNormalizado] = [
            'nombre' => $datos['nombre'],
            'apellido' => $datos['apellido'],
            'edad' => $datos['edad'],
            'ciudad' => $datos['ciudad'],
            'email' => $datos['email'],
            'codpostal' => $datos['codpostal'],
            'pais' => $datos['pais'],
            'idiomas' => $datos['idiomas'],
            'estudios' => $datos['estudios'],
        ];

        $mensaje = 'Registro guardado correctamente';
        $datos = [];
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Ingreso de datos</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <?php echo pantalla_ingreso($datos, $errores, $mensaje); ?>
</body>
</html>
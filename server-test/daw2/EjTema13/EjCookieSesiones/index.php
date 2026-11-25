<?php
    session_start();
    require_once("files/funciones.php");

    if (isset($_GET['reiniciar'])) {
        $_SESSION = [];
        session_unset();
        session_destroy();
        setcookie('cod_usuario', '', time() - 3600, '/');
        unset($_COOKIE['cod_usuario']);
    }

    $usuarioSesion = $_SESSION['cod_usuario'] ?? null;
    $usuarioCookie = $_COOKIE['cod_usuario'] ?? null;
    $usuarioValidado = is_string($usuarioSesion)
        && $usuarioSesion !== ''
        && is_string($usuarioCookie)
        && $usuarioCookie !== ''
        && $usuarioSesion === $usuarioCookie;

    if ($usuarioValidado) {
        header('Location: opciones.php');
        exit();
    }

    unset($_SESSION['cod_usuario']);
    setcookie('cod_usuario', '', time() - 3600, '/');
    unset($_COOKIE['cod_usuario']);

    if ($_SERVER['REQUEST_METHOD'] === 'POST'
        && isset($_POST['s_usuario'], $_POST['s_clave'])
        && is_string($_POST['s_usuario'])
        && is_string($_POST['s_clave'])) {
        $usuario = $_POST['s_usuario'];
        $clave = $_POST['s_clave'];

        if (!validar_usuario($usuario, $clave)) {
            $msj = 'Usuario o clave incorrectos';
            header('Location: error.php?s_msj=' . urlencode($msj));
            exit();
        }

        $_SESSION['cod_usuario'] = $usuario;
        setcookie('cod_usuario', $usuario, time() + (30 * 60), '/');
        header('Location: opciones.php');
        exit();
    }

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Ejercicio Cookies - Sesiones</title>
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <?php
        
            $mi_Heredoc = pantalla_inicio();
            echo $mi_Heredoc;
       ?>
    </body>
</html>
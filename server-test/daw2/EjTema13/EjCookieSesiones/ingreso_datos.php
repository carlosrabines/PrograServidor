<?php
    session_start();
    if (isset($_GET['action']) && $_GET['action'] === 'reset') {
        unset($_SESSION['cod_usuario']);
        setcookie('cod_usuario', '', time() - 3600, '/');
        unset($_COOKIE['cod_usuario']);
        header('Location: index.php');
        exit();
    }

    $usuarioSesion = $_SESSION['cod_usuario'] ?? null;
    $usuarioCookie = $_COOKIE['cod_usuario'] ?? null;
    $usuarioValidado = is_string($usuarioSesion)
        && $usuarioSesion !== ''
        && is_string($usuarioCookie)
        && $usuarioCookie !== ''
        && $usuarioSesion === $usuarioCookie;

    if (!$usuarioValidado) {
        unset($_SESSION['cod_usuario']);
        setcookie('cod_usuario', '', time() - 3600, '/');
        unset($_COOKIE['cod_usuario']);
        header('Location: index.php');
        exit();
    }
    $usuario = $_SESSION['cod_usuario'];

    if (!isset($_POST['n_dni']) || !isset($_POST['s_nombre']) || !isset($_POST['s_apellido']) || 
        !isset($_POST['n_edad']) || !isset($_POST['s_ciudad']) || !isset($_POST['s_email']) ||
        !isset($_POST['s_codpostal']) || !isset($_POST['s_pais'])
        ) {
        echo "Falta algún dato";
        /*
                $idiomasSeleccionados = isset($_POST['idiomas']) ? $_POST['idiomas'] : [];
                $nacion= isset($_POST['nacion']) ? $_POST['nacion'] : [];
                $aficion = isset($_POST['aficion']) ? $_POST['aficion'] : [];
        */

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
            require_once("files/funciones.php");
            $mi_Heredoc = solicita_informacion($usuario);
            echo $mi_Heredoc;
       ?>
    </body>
</html>
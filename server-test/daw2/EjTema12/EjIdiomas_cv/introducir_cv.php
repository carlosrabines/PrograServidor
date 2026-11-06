<?php
    require_once("files/funciones.php");

    /*
        Si action se ha enviado y se ha solicitado reset(cambiar preferencias)
        abandona la ejecución de Introducir_cv y vuelve al index
    */
    if (isset($_GET['action']) && $_GET['action'] === 'reset') {
        setcookie('set_color', '', time() - 3600, "/");
        setcookie('set_idioma', '', time() - 3600, "/");
        header("Location: index.php");
        exit();
    }

    //define colores e idiomas validos (podría estas en un archivo json o texto)
    $colores = [
        'celeste' => 'celeste',
        'rosa' => 'rosa',
    ];
    $idiomas = [
        'espanol' => 'es',
        'español' => 'es',
        'spanish' => 'es',
        'espagnole' => 'es',
        'es' => 'es',
        'ingles' => 'en',
        'inglés' => 'en',
        'english' => 'en',
        'anglaise' => 'en',
        'en' => 'en',
        'frances' => 'fr',
        'francés' => 'fr',
        'french' => 'fr',
        'francaise' => 'fr',
        'fr' => 'fr',
    ];

    $preferenciasElegidas = validaPreferenciasElegidas($colores, $idiomas);
    if ($preferenciasElegidas === false) {
        header("Location: index.php");
        exit();
    }

    $colorElegido = $preferenciasElegidas['colorElegido'];
    $idiomaElegido = $preferenciasElegidas['idiomaElegido'];
    $color = $colores[$colorElegido];
    $idioma = $idiomas[$idiomaElegido];

    if (isset($_POST['rd_color'], $_POST['rd_idioma']) || isset($_POST['color'], $_POST['lang'])) {
        setcookie('set_color', $color, time() + (30 * 24 * 60 * 60), "/");
        setcookie('set_idioma', $idioma, time() + (30 * 24 * 60 * 60), "/");
    }

    $jsonData = file_get_contents(__DIR__ . '/data/idiomas.json');
    if ($jsonData === false) {
        trigger_error('No se pudo leer el archivo de idiomas.', E_USER_ERROR);
    }

    $dataIdiomas = json_decode($jsonData, true);
    if (!is_array($dataIdiomas) || !isset($dataIdiomas[$idioma])) {
        trigger_error('El archivo de traducciones no contiene el idioma solicitado.', E_USER_ERROR);
    }
    $dataIdioma = $dataIdiomas[$idioma];
    $mi_Heredoc = presentacion_cv($dataIdioma);
?>

<!DOCTYPE html>
<html lang="<?php echo htmlspecialchars($idioma, ENT_QUOTES, 'UTF-8'); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo htmlspecialchars($dataIdioma['title_cv'], ENT_QUOTES, 'UTF-8'); ?></title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body class="tema-<?php echo htmlspecialchars($color, ENT_QUOTES, 'UTF-8'); ?>">
    <?php
        echo $mi_Heredoc; 
    ?>
</body>
</html>

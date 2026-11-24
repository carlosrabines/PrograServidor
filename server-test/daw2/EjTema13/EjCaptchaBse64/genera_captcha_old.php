<?php
// Indicar al navegador que esto es una imagen JPEG
header('Content-Type: image/jpeg');

// Crear la imagen de 200x100
// 1. Cargar la imagen original
$original = imagecreatefromjpeg(__DIR__ . '/img/fondo.jpeg');
$texto = $_GET['texto'] ?? '';
if (!is_string($texto)) {
    $texto = '';
}
$texto = substr(preg_replace('/[^A-Za-z0-9]/', '', $texto) ?? '', 0, 10);

$ancho_orig = imagesx($original);
$alto_orig  = imagesy($original);

// Definir el nuevo tamaño
$nuevo_ancho = 200;
$nuevo_alto = 100;

// 2. Crear un nuevo lienzo vacío del tamaño deseado
$destino = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);

// 3. Copiar y redimensionar
imagecopyresampled(
    $destino, $original, 
    0, 0, 0, 0, 
    $nuevo_ancho, $nuevo_alto, 
    $ancho_orig, $alto_orig
);

// 4. Dibujar los caracteres con distintas alturas
$color_texto = imagecolorallocate($destino, 255, 255, 255);
$ancho_caracter = imagefontwidth(15);
$ancho_texto = strlen($texto) * $ancho_caracter + max(0, strlen($texto) - 1) * 5;
$posicion_x = (int) (($nuevo_ancho - $ancho_texto) / 2);

for ($i = 0; $i < strlen($texto); $i++) {
    imagestring(
        $destino,
        5,
        $posicion_x,
        random_int(20, 65),
        $texto[$i],
        $color_texto
    );
    $posicion_x += $ancho_caracter + 5;
}

// 5. Enviar la imagen generada al navegador
imagejpeg($destino, null, 90);

// Liberar memoria
imagedestroy($original);
imagedestroy($destino);

?>

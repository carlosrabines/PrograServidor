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
$texto = substr(preg_replace('/[^A-Z0-9]/', '', $texto) ?? '', 0, 10);

$ancho_orig = imagesx($original);
$alto_orig  = imagesy($original);

// Definir el nuevo tamaño
$nuevo_ancho = 450;
$nuevo_alto = 150;

// 2. Crear un nuevo lienzo vacío del tamaño deseado
$destino = imagecreatetruecolor($nuevo_ancho, $nuevo_alto);

// 3. Copiar y redimensionar
imagecopyresampled(
    $destino, $original, 
    0, 0, 0, 0, 
    $nuevo_ancho, $nuevo_alto, 
    $ancho_orig, $alto_orig
);

// 3. Configuración del texto y fuente
$fuente = __DIR__ . '/fuente/OpenSans-Regular.ttf';
$tamanoFuente = 30;
$colorTexto = imagecolorallocate($destino, 255, 255, 255);

// Posición inicial en el eje X y Y
$x = 30;
$y = 65;
$espaciado = 70; // Espacio horizontal entre cada letra

// 4. Recorrer el texto letra por letra
for ($i = 0; $i < strlen($texto); $i++) {
    $y = rand(50, 80);

    $letra = $texto[$i];
    
    $angulo = rand(-75, 75);
    
    // Dibujar la letra rotada
    imagettftext($destino, $tamanoFuente, $angulo, $x, $y, $colorTexto, $fuente, $letra);
    
    // Avanzar la posición X para la siguiente letra
    $x += $espaciado;
}

// 5. Mostrar la imagen en el navegador
imagejpeg($destino);


// Liberar memoria
imagedestroy($original);
imagedestroy($destino);

?>

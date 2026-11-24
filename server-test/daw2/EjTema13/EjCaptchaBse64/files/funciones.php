<?php

    function genera_imagen_base64(string $texto) {
        // Crear la imagen de 200x100
        // 1. Cargar la imagen original
        $original = imagecreatefromjpeg(dirname(__DIR__) . '/img/fondo.jpeg');
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
        $fuente = dirname(__DIR__) . '/fuente/OpenSans-Regular.ttf';
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

        // 5. Codificar los bytes JPEG para usarlos como una URL de datos
        ob_start();
        $imagenGenerada = imagejpeg($destino, null, 90);
        $datosImagen = ob_get_clean();

        // Liberar memoria
        imagedestroy($original);
        imagedestroy($destino);

        if (!$imagenGenerada || $datosImagen === false) {
            throw new RuntimeException('No se pudo generar la imagen CAPTCHA.');
        }

        return 'data:image/jpeg;base64,' . base64_encode($datosImagen);
    }


    function pantalla_inicio() {
//        $caracteres = 'AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz0123456789';
        $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $txt_Captcha = '';
        for ($i = 0; $i < 6; $i++) {
            $txt_Captcha .= $caracteres[random_int(0, strlen($caracteres) - 1)];
        }

        $imagen_captcha_base64 = genera_imagen_base64($txt_Captcha);

        $heredoc = <<<EOD
            <h1>Ejercicio Captcha</h1>
            <form action='{$_SERVER['PHP_SELF']}' method='POST'>
                <div class='contenedor'>
                    <table>
                        <tr>
                            <td>
                                <img src='$imagen_captcha_base64' alt='Gráfico generado con PHP GD'><br>
                                <input type='hidden' id='id_captcha' name='s_captcha' value='{$txt_Captcha}' readonly >
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for='id_textousr'>Ingresar Texto-Captcha</label>
                                <input type='text' id='id_textousr' name='s_textousr' required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button type='submit' class='botones' name='accion' value='Enviar'>Enviar</button>
                            </td>
                        </tr>
                    </table>
                </div>
            </form>
        EOD;
        return $heredoc;
    }

?>
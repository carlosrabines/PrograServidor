<?php

    function pantalla_inicio() {
//        $caracteres = 'AaBbCcDdEeFfGgHhIiJjKkLlMmNnOoPpQqRrSsTtUuVvWwXxYyZz0123456789';
        $caracteres = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $txt_Captcha = '';
        for ($i = 0; $i < 6; $i++) {
            $txt_Captcha .= $caracteres[random_int(0, strlen($caracteres) - 1)];
        }

        $heredoc = <<<EOD
            <h1>Ejercicio Captcha</h1>
            <form action='{$_SERVER['PHP_SELF']}' method='POST'>
                <div class='contenedor'>
                    <table>
                        <tr>
                            <td>
                                <img src='genera_captcha.php?texto={$txt_Captcha}' alt='Gráfico generado con PHP GD'><br>
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
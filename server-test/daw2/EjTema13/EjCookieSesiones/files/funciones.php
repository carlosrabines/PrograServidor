<?php

    function html_estudios() {
        
        $arr_estudios = obtener_estudios();

        $s_html = "<fieldset class='checkbox-grupo'>\n"
                ."<legend>Estudios:</legend>\n";

        foreach($arr_estudios as $codigo => $estudio) {
            $s_html .= "<label><input class='checkbox-opcion' type='checkbox' name='estudios[]' value='$estudio' /> $estudio</label><br>\n";
        }
        $s_html .= "</fieldset><br />\n";

        return $s_html;
    }

    function obtener_estudios() {
        return [
            'Bach' => 'Bachillerato',
            'Grba' => 'Grado_basico',
            'Grme' => 'Grado_medio',
            'Gesu' => 'Grado_superior',
            'Univ' => 'Universidad',
            'Mast' => 'Master',
            'Doct' => 'Doctorado'
        ];
    }

    function html_idiomas() {
        
        $arr_idiomas = obtener_idiomas();

        $s_html = "<fieldset class='checkbox-grupo'>\n"
                ."<legend>idiomas:</legend>\n";

        foreach($arr_idiomas as $codigo => $idioma) {
            $s_html .= "<label><input class='checkbox-opcion' type='checkbox' name='idiomas[]' value='$idioma' /> $idioma</label><br>\n";
        }
        $s_html .= "</fieldset><br />\n";

        return $s_html;
    }

    function obtener_idiomas() {
        return [
            'en' => 'inglés',
            'es' => 'español',
            'fr' => 'francés',
            'de' => 'alemán'
        ];
    }

    function validar_usuario(string $s_usuario, string $s_clave) {

        $arr_usuarios = obtener_usuarios();
        
        $s_clave_hash = hash('sha256', $s_clave);

        foreach ($arr_usuarios as $usuario) {
            if ($usuario['usuario'] === $s_usuario) {
                if (hash_equals($usuario['password'], $s_clave_hash)) {
                    return true; 
                }
                return false; 
            }
        }
        return false;
    }

    function obtener_usuarios() {
        // Usuarios de SenderoNet (datos de ejemplo para el examen)
        // Las contraseñas están guardadas con hash('sha256', $password).
        // Uso: $usuarios = require 'datos/usuarios.php';
         // password: 1234
         // password: monte2026
         // password: admin2026
         return [
            ['usuario' => 'ana',      'password' => '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'rol' => 'socio'],
            ['usuario' => 'luis',     'password' => 'd7737851b8acdbd88d7dc730260b8bff9e08653c9e27e8aed3c2b6fb1057162c', 'rol' => 'socio'],
            ['usuario' => 'admin',    'password' => '6051fc84a7a0d74c225fb18a496b09952da5642e60723ecae543298edd7d82d6', 'rol' => 'admin']
      ];
    }

    function solicita_informacion($usuario) {

    /*
                                    <label for='id_idiomas'> Idiomas: </label>
                                <input type='text' id='id_idiomas' name='s_idiomas' required />
    */
        $html_idiomas = html_idiomas();
        $html_estudios = html_estudios();

        $heredoc = <<<EOT
            <h3>Usuario: {$usuario}</h3>
            <h1>Ejercicio cookies - Sesiones</h1>
            <form action='{$_SERVER['PHP_SELF']}' method='POST'>
                <div class='contenedor'>
                    <table>
                        <tr>
                            <td>
                                <label for='id_dni'> DNI: </label>
                                <input type='text' id='id_dni' name='n_dni' required />
                            </td>
                            <td>
                                <label for='id_nombre'>Nombre:</label>
                                <input type='text' id='id_nombre' name='s_nombre' required>
                            </td>
                            <td>
                                <label for='id_apellido'>Apellido:</label>
                                <input type='text' id='id_apellido' name='s_apellido' required>
                            </td>
                            <td>
                                <label for='id_edad'> Edad [18 - 120]: </label>
                                <input type='number' id='id_edad' name='n_edad' min='18' max='120' required />
                            </td>
                            <td>
                                <label for='id_ciudad'> Ciudad: </label>
                                <input type='text' id='id_ciudad' name='s_ciudad' required />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for='id_email'>e-mail:</label>
                                <input type='email' id='id_email' name='s_email' required>
                            </td>
                            <td>
                                <label for='id_codpostal'>Cod.Postal:</label>
                                <input type='text' id='id_codpostal' name='s_codpostal' required>
                            </td>
                            <td>
                                <label for='id_pais'> País: </label>
                                <input type='text' id='id_pais' name='s_pais' required />
                            </td>
                            <td>
                                $html_idiomas
                            </td>
                            <td>
                                $html_estudios
                            </td>
                        </tr>
                    </table>
                    <br><br>
                    <button type='submit' class='botones' name='accion' value='Enviar'>Enviar</button>
                    <br><br>
                    <a href='ingreso_datos.php?action=reset'>Reiniciar</a>
                </div>
            </form>
        EOT;
        return $heredoc;
    }

    function pantalla_inicio() {
        $heredoc = <<<EOT
            <h1>Ejercicio cookies - Sesiones</h1>
            <form action='{$_SERVER['PHP_SELF']}' method='POST'>
                <div class='contenedor'>
                    <table>
                        <tr>
                            <td>
                                <label for='id_usuario'>usuario:</label>
                                <input type='text' id='id_usuario' name='s_usuario' required>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for='id_clave'>Contraseña:</label>
                                <input type='password' id='id_clave' name='s_clave' required>
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
        EOT;
        return $heredoc;
    }

?>
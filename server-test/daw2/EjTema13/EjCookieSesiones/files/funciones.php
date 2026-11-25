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

    function usuario_autenticado(): bool
    {
        $usuarioSesion = $_SESSION['cod_usuario'] ?? null;
        $usuarioCookie = $_COOKIE['cod_usuario'] ?? null;

        return is_string($usuarioSesion)
            && $usuarioSesion !== ''
            && is_string($usuarioCookie)
            && $usuarioCookie !== ''
            && $usuarioSesion === $usuarioCookie;
    }

    function escape_html(string $valor): string
    {
        return htmlspecialchars($valor, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }

    function pantalla_opciones(): string
    {
        return "<h1>Opciones</h1>\n"
            . "<nav>\n"
            . "<ul>\n"
            . "<li><a href='index.php?reiniciar=1'>Reiniciar</a></li>\n"
            . "<li><a href='ingreso_datos.php'>Ingreso de datos</a></li>\n"
            . "<li><a href='visualizar_registros.php'>Visualizar registros</a></li>\n"
            . "<li><a href='buscar_registro.php'>Buscar un Registro</a></li>\n"
            . "</ul>\n"
            . "</nav>\n";
    }

    function pantalla_buscar_registro(string $dni = '', string $error = ''): string
    {
        $dni = escape_html($dni);
        $errorHtml = $error !== ''
            ? "<p class='error'>" . escape_html($error) . "</p>\n"
            : '';

        return "<h1>Buscar un Registro</h1>\n"
            . $errorHtml
            . "<form action='buscar_registro.php' method='POST'>\n"
            . "<p><label for='dni_busqueda'>DNI:</label>\n"
            . "<input type='text' id='dni_busqueda' name='dni_busqueda' value='$dni'></p>\n"
            . "<button type='submit' class='botones'>Buscar</button>\n"
            . "</form>\n"
            . "<p><a href='opciones.php'>Volver a opciones</a></p>\n";
    }

    function pantalla_registro_buscado(string $dni, array $registro): string
    {
        $html = "<h1>Registro encontrado</h1>\n"
            . "<table>\n"
            . "<tbody>\n"
            . "<tr><th>DNI</th><td>" . escape_html($dni) . "</td></tr>\n"
            . "<tr><th>Nombre</th><td>" . escape_html((string) ($registro['nombre'] ?? '')) . "</td></tr>\n"
            . "<tr><th>Apellido</th><td>" . escape_html((string) ($registro['apellido'] ?? '')) . "</td></tr>\n"
            . "<tr><th>Edad</th><td>" . escape_html((string) ($registro['edad'] ?? '')) . "</td></tr>\n"
            . "<tr><th>Ciudad</th><td>" . escape_html((string) ($registro['ciudad'] ?? '')) . "</td></tr>\n"
            . "<tr><th>Correo</th><td>" . escape_html((string) ($registro['email'] ?? '')) . "</td></tr>\n"
            . "<tr><th>Código postal</th><td>" . escape_html((string) ($registro['codpostal'] ?? '')) . "</td></tr>\n"
            . "<tr><th>País</th><td>" . escape_html((string) ($registro['pais'] ?? '')) . "</td></tr>\n"
            . "<tr><th>Idiomas</th><td>" . escape_html(implode(', ', $registro['idiomas'] ?? [])) . "</td></tr>\n"
            . "<tr><th>Estudios</th><td>" . escape_html(implode(', ', $registro['estudios'] ?? [])) . "</td></tr>\n"
            . "</tbody>\n"
            . "</table>\n"
            . "<p><a href='buscar_registro.php'>Buscar otro DNI</a></p>\n"
            . "<p><a href='opciones.php'>Volver a opciones</a></p>\n";

        return $html;
    }

    function pantalla_sin_registro_busqueda(string $dni = ''): string
    {
        return "<h1>Registros realizados</h1>\n"
            . "<p>No existe registro dni: " . escape_html($dni) . "</p>\n"
            . "<p><a href='buscar_registro.php'>Buscar otro DNI</a></p>\n"
            . "<p><a href='ingreso_datos.php'>Realizar un nuevo registro</a></p>\n"
            . "<p><a href='opciones.php'>Volver a opciones</a></p>\n";
    }

    function dni_es_valido(string $dni): bool
    {
        $dni = strtoupper(str_replace([' ', '-'], '', trim($dni)));

        if (!preg_match('/^[0-9]{8}[A-Z]$/', $dni)) {
            return false;
        }

        $letras = 'TRWAGMYFPDXBNJZSQVHLCKE';
        $numero = (int) substr($dni, 0, 8);

        return substr($dni, 8, 1) === $letras[$numero % 23];
    }

    function ciudad_europea(string $ciudad): bool
    {
        $ciudades = [
            'madrid', 'barcelona', 'valencia', 'sevilla', 'bilbao', 'zaragoza',
            'malaga', 'murcia', 'palma', 'lisboa', 'porto', 'paris', 'lyon',
            'marsella', 'londres', 'manchester', 'berlin', 'munich', 'hamburgo',
            'roma', 'milano', 'milán', 'napoles', 'napoli', 'viena', 'vienna',
            'amsterdam', 'bruselas', 'brussels', 'praga', 'prague', 'varsovia',
            'warsaw', 'dublin', 'oslo', 'estocolmo', 'stockholm', 'copenhague',
            'copenhagen', 'atenas', 'athens', 'budapest', 'bucarest', 'bucharest',
            'sofia', 'zagreb', 'liubliana', 'ljubljana', 'bratislava', 'tallin',
            'tallinn', 'riga', 'vilna', 'vilnius', 'helsinki', 'zurich', 'zúrich',
            'ginebra', 'geneva', 'monaco', 'mónaco', 'andorra la vella',
            'reikiavik', 'reykjavik', 'la valeta', 'valletta', 'luxemburgo',
            'luxembourg', 'sarajevo', 'belgrado', 'belgrade', 'podgorica',
            'tirana', 'skopje', 'chisinau', 'kiev', 'kyiv', 'moscu', 'moscow'
        ];

        //mb_strtolower() retira espacios en blanco y hace minúsculas de tildes, dieresis y ñ
        $ciudadNormalizada = function_exists('mb_strtolower')
            ? mb_strtolower(trim($ciudad), 'UTF-8')
            : strtolower(trim($ciudad));

        //iconv() para transformar de UTF-8 a caracteres ASCII, descartando los que no puede
        $transliterada = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $ciudadNormalizada);
        if (is_string($transliterada) && $transliterada !== '') {
            $ciudadNormalizada = strtolower($transliterada);
        }

        return in_array($ciudadNormalizada, $ciudades, true);
    }

    function clase_invalida(array $errores, string $campo): string
    {
        return isset($errores[$campo]) ? " class='invalido'" : '';
    }

    function clase_label(array $errores, string $campo): string
    {
        return isset($errores[$campo]) ? " class='invalido'" : '';
    }

    function pantalla_ingreso(array $datos = [], array $errores = [], string $mensaje = ''): string {
        $dni = escape_html($datos['dni'] ?? '');
        $nombre = escape_html($datos['nombre'] ?? '');
        $apellido = escape_html($datos['apellido'] ?? '');
        $edad = escape_html($datos['edad'] ?? '');
        $ciudad = escape_html($datos['ciudad'] ?? '');
        $email = escape_html($datos['email'] ?? '');
        $codpostal = escape_html($datos['codpostal'] ?? '');
        $pais = escape_html($datos['pais'] ?? '');

        $mensajeHtml = $mensaje !== ''
            ? "<p class='correcto'>" . escape_html($mensaje) . "</p>\n"
            : '';

        $erroresHtml = '';
        if ($errores !== []) {
            $erroresHtml = "<ul class='error'>\n";
            foreach ($errores as $error) {
                $erroresHtml .= "<li>" . escape_html($error) . "</li>\n";
            }
            $erroresHtml .= "</ul>\n";
        }

        $idiomas = ['inglés', 'español', 'francés', 'alemán'];
        $idiomasSeleccionados = $datos['idiomas'] ?? [];
        $claseIdiomas = isset($errores['idiomas']) ? " class='invalido'" : '';
        $idiomasHtml = "<fieldset><legend$claseIdiomas>Idiomas:</legend>\n";
        foreach ($idiomas as $idioma) {
            $checked = in_array($idioma, $idiomasSeleccionados, true) ? " checked" : '';
            $idiomasHtml .= "<label><input type='checkbox' name='idiomas[]' value='"
                . escape_html($idioma) . "'" . $checked . "> "
                . escape_html($idioma) . "</label><br>\n";
        }
        $idiomasHtml .= "</fieldset>\n";

        $estudios = obtener_estudios();
        $estudiosSeleccionados = $datos['estudios'] ?? [];
        $claseEstudios = isset($errores['estudios']) ? " class='invalido'" : '';
        $estudiosHtml = "<fieldset><legend$claseEstudios>Estudios:</legend>\n";
        foreach ($estudios as $estudio) {
            $checked = in_array($estudio, $estudiosSeleccionados, true) ? " checked" : '';
            $estudiosHtml .= "<label><input type='checkbox' name='estudios[]' value='"
                . escape_html($estudio) . "'" . $checked . "> "
                . escape_html($estudio) . "</label><br>\n";
        }
        $estudiosHtml .= "</fieldset>\n";

        return "<h1>Ingreso de datos</h1>\n"
            . $mensajeHtml
            . $erroresHtml
            . "<form action='ingreso_datos.php' method='POST'>\n"
            . "<table>\n"
                . "<tr>\n"
                    . "<td><label for='dni'" . clase_label($errores, 'dni') . ">DNI:</label>\n"
                        . "<input type='text' id='dni' name='n_dni' value='$dni'"
                        . clase_invalida($errores, 'dni') . ">\n"
                    . "</td>\n"
                    . "<td><label for='nombre'" . clase_label($errores, 'nombre') . ">Nombre:</label>\n"
                        . "<input type='text' id='nombre' name='s_nombre' value='$nombre'"
                        . clase_invalida($errores, 'nombre') . ">\n"
                    . "</td>\n"
                    . "<td><label for='apellido'" . clase_label($errores, 'apellido') . ">Apellido:</label>\n"
                        . "<input type='text' id='apellido' name='s_apellido' value='$apellido'"
                        . clase_invalida($errores, 'apellido') . ">\n"
                    . "</td>\n"
                    . "<td><label for='edad'" . clase_label($errores, 'edad') . ">Edad:</label>\n"
                        . "<input type='number' id='edad' name='n_edad' min='18' max='120' value='$edad'"
                       . clase_invalida($errores, 'edad') . ">\n"
                    . "</td>\n"
                    . "<td><label for='ciudad'" . clase_label($errores, 'ciudad') . ">Ciudad:</label>\n"
                        . "<input type='text' id='ciudad' name='s_ciudad' value='$ciudad'"
                        . clase_invalida($errores, 'ciudad') . ">\n"
                    . "</td>\n"
                . "</tr>\n"
                . "<tr>\n"
                    . "<td><label for='email'" . clase_label($errores, 'email') . ">e-mail:</label>\n"
                        . "<input type='email' id='email' name='s_email' value='$email'"
                        . clase_invalida($errores, 'email') . ">\n"
                    . "</td>\n"
                    . "<td><label for='codpostal'" . clase_label($errores, 'codpostal') . ">Código postal:</label>\n"
                        . "<input type='text' id='codpostal' name='s_codpostal' value='$codpostal'"
                        . clase_invalida($errores, 'codpostal') . ">\n"
                    . "</td>\n"
                    . "<td><label for='pais'" . clase_label($errores, 'pais') . ">País:</label>\n"
                        . "<input type='text' id='pais' name='s_pais' value='$pais'"
                        . clase_invalida($errores, 'pais') . ">\n"
                    . "</td>\n"
                    . "<td>$idiomasHtml</td>\n"
                    . "<td>$estudiosHtml</td>\n"
                . "</tr>\n"
            . "</table>\n"
            . "<br><button type='submit' class='botones'>Guardar registro</button>\n"
            . "</form>\n"
            . "<p><a href='opciones.php'>Volver a opciones</a></p>\n";
    }

    function pantalla_registros(): string
    {
        $registros = $_SESSION['registro'] ?? [];
        $html = "<h1>Registros realizados</h1>\n";

        if (!is_array($registros) || $registros === []) {
            $html .= "<p>No hay registros guardados.</p>\n";
        } else {
            $html .= "<table>\n"
                        . "<thead>\n"
                            . "<tr>\n"
                                . "<th>DNI</th>\n"
                                . "<th>Nombre</th>\n"
                                . "<th>Apellido</th>\n"
                                . "<th>Edad</th>\n"
                                . "<th>Ciudad</th>\n"
                                . "<th>Correo</th>\n"
                                . "<th>Código postal</th>\n"
                                . "<th>País</th>\n"
                                . "<th>Idiomas</th>\n"
                                . "<th>Estudios</th>\n"
                            . "</tr>\n"
                        . "</thead>\n"
                    . "<tbody>\n";

            foreach ($registros as $dni => $registro) {
                $html .= "<tr>\n"
                        . "<td>" . escape_html((string) $dni) . "</td>\n"
                        . "<td>" . escape_html((string) ($registro['nombre'] ?? '')) . "</td>\n"
                        . "<td>" . escape_html((string) ($registro['apellido'] ?? '')) . "</td>\n"
                        . "<td>" . escape_html((string) ($registro['edad'] ?? '')) . "</td>\n"
                        . "<td>" . escape_html((string) ($registro['ciudad'] ?? '')) . "</td>\n"
                        . "<td>" . escape_html((string) ($registro['email'] ?? '')) . "</td>\n"
                        . "<td>" . escape_html((string) ($registro['codpostal'] ?? '')) . "</td>\n"
                        . "<td>" . escape_html((string) ($registro['pais'] ?? '')) . "</td>\n"
                        . "<td>" . escape_html(implode(', ', $registro['idiomas'] ?? [])) . "</td>\n"
                        . "<td>" . escape_html(implode(', ', $registro['estudios'] ?? [])) . "</td>\n"
                    . "</tr>\n";
            }
            $html .= "</tbody>\n"
                . "</table>\n";
        }

        $html .= "<p><a href='ingreso_datos.php'>Realizar un nuevo registro</a></p>\n"
            . "<p><a href='opciones.php'>Volver a opciones</a></p>\n";

        return $html;
    }

?>
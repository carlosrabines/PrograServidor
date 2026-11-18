<?php

    function solicita_informacion($usuario) {
        $heredoc = <<<EOT
            <h3>Usuario: {$usuario}</h3>
            <h1>Ejercicio cookies - Sesiones</h1>
            <form action='introducir_cv.php' method='POST'>
                <div class='contenedor'>
                    <table>
                        <tr>
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
                                <label for='id_dni'> DNI: </label>
                                <input type='text' id='id_dni' name='n_dni' required />
                            </td>
                            <td>
                                <label for='id_ciudad'> Ciudad: </label>
                                <input type='text' id='id_ciudad' name='s_ciudad' required />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label for='id_ciudad'>Ciudad:</label>
                                <input type='text' id='id_ciudad' name='s_ciudad' required>
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
                                <label for='id_estudios'> Estudios: </label>
                                <input type='text' id='id_estudios' name='s_estudios' required />
                            </td>
                            <td>
                                <label for='id_idiomas'> Idiomas: </label>
                                <input type='text' id='id_idiomas' name='s_idiomas' required />
                            </td>
                        </tr>
                    </table>
                    <br><br>
                    <button type='submit' class='botones' name='accion' value='Enviar'>Enviar</button>
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
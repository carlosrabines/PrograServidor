<?php
    function defineFechaLimite() {
        $fecha_hoy = new DateTime();
        $fecha_hoy = $fecha_hoy->modify("-18 years");
        return $fecha_hoy->format('Y-m-d');
    }

    function pantalla_inicio() {
        $fechaLimite = defineFechaLimite();

        $html = "<h1>Registro de Datos</h1>";
        $html .= "<form action='{$_SERVER['PHP_SELF']}' method='POST'>\n";
        $html .= "<table>\n";
        $html .= "<tr>\n";
        $html .= "<td><label for='id_nombre'> Nombre(s): </label><input type='text' id='id_nombre' name='s_nombre' required /></td>\n";
        $html .= "<td><label for='id_apellido'> Apellido(s): </label><input type='text' id='id_apellido' name='s_apellido' required /></td>\n";
        $html .= "<td><label for='id_fnac'>F.Nacimiento: </label><input type='date' id='id_fnac' name='fnac' max='$fechaLimite' required></td>\n"
              . "</tr>\n"
              . "</table>\n";

        $html .= "<table>"
              ."<tr>\n"
              ."<td>\n"
              ."<fieldset  class='radio-grupo'>\n"
              ."<legend>Sexo:</legend>\n"
              ."<label class='radio-opcion' ><input type='radio' name='sexo' value='Mujer' required /> Mujer</label>\n"
              ."<label class='radio-opcion' ><input type='radio' name='sexo' value='Hombre' required /> Hombre</label>\n"
              ."<label class='radio-opcion' ><input type='radio' name='sexo' value='No indica' required checked /> No indica</label>\n"
              ."</fieldset>\n"
              ."</td>\n";

        $html .= "<td>\n"
              ."<fieldset class='checkbox-grupo'>\n"
              ."<legend>Indica idiomas:</legend>\n"
              ."<label><input class='checkbox-opcion' type='checkbox' name='idiomas[]' value='Inglés' /> Inglés</label>\n"
              ."<label><input class='checkbox-opcion' type='checkbox' name='idiomas[]' value='Francés' /> Francés</label>\n"
              ."<label><input class='checkbox-opcion' type='checkbox' name='idiomas[]' value='Español' /> Español</label>\n"
              ."<label><input class='checkbox-opcion' type='checkbox' name='idiomas[]' value='Italiano' /> Italiano</label>\n"
              ."<label><input class='checkbox-opcion' type='checkbox' name='idiomas[]' value='Portugués' /> Portugués</label>\n"
              ."</fieldset><br />\n"
              ."</td>\n"
              ."</tr>\n";

        $html .= "<tr>\n"
              ."<td>\n"
              ."<fieldset>\n"
              ."<legend>Nacionalidad:</legend>\n"
              ."<select id='id_nacion' name='nacion[]' required multiple>\n"
              ."<option value='' disabled selected>-- Seleccione una --</option>\n"
              ."<option value='Francesa'>Francia</option>\n"
              ."<option value='Española'>España</option>\n"
              ."<option value='Italiana'>Italia</option>\n"
              ."<option value='Portuguesa'>Portugal</option>\n"
              ."</select>\n"
              ."</fieldset>\n"
              ."</td>\n";

        $html .= "<td>\n"
              ."<fieldset>\n"
              ."<legend>Afición: </legend>\n"
              ."<select id='id_aficion' name='aficion[]' required multiple>\n"
              ."<option value='' disabled selected>-- Seleccione una --</option>\n"
              ."<option value='Futbol'>Fútbol</option>\n"
              ."<option value='Padel'>Padel</option>\n"
              ."<option value='Ajedrez'>Ajedrez</option>\n"
              ."<option value='Natacion'>Natación</option>\n"
              ."</select>\n"
              ."</fieldset>\n"
              ."</td>\n"
              ."</tr>\n"
              ."</table>\n";

        $html .= "<button type='submit'>Registrar</button>\n";
        $html .= "</form>\n";

        return $html;
    }

    function pantalla_SegundaLLamada($s_nombre, $s_apellido, $fnac, $sexo, $idiomasSeleccionados, $nacion, $aficion) {
        $html = "<h1>Datos Registrados</h1>\n"
        ."<form action='{$_SERVER['PHP_SELF']}' method='POST'>\n"
        ."<table>"
            ."<tr>\n"
                ."<td>\n"
                    ."<label> Nombre(s): " . htmlspecialchars($s_nombre) . "</label><br /><br />\n"
                ."</td>\n"
                ."<td>\n"
                    ."<label> Apellido(s): " . htmlspecialchars($s_apellido) . "</label><br /><br />\n"
                ."</td>\n"
                ."<td>\n"
                    ."<label> F.Nacimiento: " . htmlspecialchars($fnac) . "</label><br /><br />\n"
                ."</td>\n"
                ."<td>\n"
                    ."<label> Sexo: " . htmlspecialchars($sexo) . "</label><br /><br />\n"
                ."</td>\n"
            ."<tr>\n"
        ."</table>"
        ."<table>"
            ."<tr>\n"
                ."<td>\n"
                    ."<p>Idiomas: " . htmlspecialchars(implode(", ", $idiomasSeleccionados)) . "</p>"
                ."</td>\n"
                ."<td>\n"
                    ."<label> Nacionalidad: " . htmlspecialchars(implode(", ", $nacion)) . "</label><br /><br />\n"
                ."</td>\n"
                ."<td>\n"
                    ."<label> Afición: " . htmlspecialchars(implode(", ", $aficion)) . "</label><br /><br />\n"
                ."</td>\n"
            ."</tr>\n"
        ."</table>\n"
        ."<br>\n"
        ."<button type='submit'>Nuevo Registro</button>\n"
        ."</form>\n";

        return $html;
    }

?>
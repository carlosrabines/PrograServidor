<?php

    function defineFechaLimite() {
        $fecha_hoy = new DateTime();
        $fecha_hoy = $fecha_hoy->modify("-18 years");
        return $fecha_hoy->format('Y-m-d');
    }

    function mensajeErrorArchivoSubido($error) {
        $mensaje = "Error: ";

        switch ($error) {
            case UPLOAD_ERR_INI_SIZE: //1
            case UPLOAD_ERR_FORM_SIZE: //2
                $mensaje .= "El archivo es demasiado grande.";
                break;
            case UPLOAD_ERR_PARTIAL: //3
                $mensaje .= "El archivo se subió parcialmente.";
                break;
            case UPLOAD_ERR_NO_FILE: //4
                $mensaje .= "No se subió ningún archivo.";
                break;
            case UPLOAD_ERR_NO_TMP_DIR: //6
                $mensaje .= "Falta la carpeta temporal.";
                break;
            case UPLOAD_ERR_CANT_WRITE: //7
                $mensaje .= "No se pudo escribir el archivo en el disco.";
                break;
            case UPLOAD_ERR_EXTENSION: //8
                $mensaje .= "Una extensión de PHP detuvo la subida del archivo.";
                break;
            default:
                $mensaje .= "Error desconocido al subir el archivo.";
                break;
        }
        return $mensaje;
    }

    function pantalla_inicio() {
        $fechaLimite = defineFechaLimite();

        //ENCTYPE al <form para permitir la carga de archivo  
        $html = "<h1>Buscar Fotos</h1>"
        ."<form action='{$_SERVER['PHP_SELF']}' method='POST' ENCTYPE='multipart/form-data'>\n"
            ."<table>\n"
                ."<tr>\n"
                    ."<td><label for='id_nombre'> Nombre(s): </label><input type='text' id='id_nombre' name='s_nombre' required /></td>\n"
                    ."<td><label for='id_apellido'> Apellido(s): </label><input type='text' id='id_apellido' name='s_apellido' required /></td>\n"
                    ."<td><button type='submit' value='Buscar ' >Buscar Foto</button>\n"
              . "</tr>\n"
              . "</table>\n";
        $html .= "</form>\n";

        return $html;
    }

    function pantalla_SegundaLLamada($s_nombre, $s_apellido, $arr_archivos) {
        $html = "<h1>Buscar Foto</h1>\n"
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
                  ."<select id='id_foto' name='archivo_foto[]' required>\n"
                      ."<option value='' disabled selected>-- Seleccione un archivo --</option>\n";

        foreach ($arr_archivos as $archivo) {
            $html .= "<option value='$archivo'>" . htmlspecialchars($archivo) . "</option>\n";
        }
        
        $html .= "</select>\n"
                ."</td>\n"
                ."<td>\n"
                    ."<button type='submit'>Mostrar Foto</button>\n"
                ."</td>\n"
            ."<tr>\n"
        ."</table>"
        ."<br>\n"
        ."<input type='hidden' name='s_nombre' value='$s_nombre'>\n"
        ."<input type='hidden' name='s_apellido' value='$s_apellido'>\n"
        ."</form>\n";

        return $html;
    }

    function pantalla_MuestraFoto($s_nombre, $s_apellido, $s_nombre_archivo) {
        $html = "<h1>Buscar Foto</h1>\n"
        ."<form action='{$_SERVER['PHP_SELF']}' method='POST'>\n"
        ."<table>"
            ."<tr>\n"
                ."<td>\n"
                    ."<label> Nombre(s): " . htmlspecialchars($s_nombre) . "</label><br /><br />\n"
                ."</td>\n"
                ."<td>\n"
                    ."<label> Apellido(s): " . htmlspecialchars($s_apellido) . "</label><br /><br />\n"
                ."</td>\n"
            ."<tr>\n"
        ."</table>"
        ."<img src='$s_nombre_archivo ' alt='Foto buscadaa'>\n"        
        ."<br>\n"
        ."<button type='submit'>Nueva Búsqueda</button>\n"
        ."</form>\n";

        return $html;
    }

?>
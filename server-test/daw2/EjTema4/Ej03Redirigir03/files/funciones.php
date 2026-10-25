<?php

    function pantalla_inicio() {

        //ENCTYPE al <form para permitir la carga de archivo  
        $html = "<h1>Credenciales de Acceso</h1>"
        ."<form action='{$_SERVER['PHP_SELF']}' method='POST' >\n"
            ."<table>\n"
                ."<tr>\n"
                    ."<td><label for='id_usr'> Usuario: </label><input type='text' id='id_usr' name='s_usr' required /></td>\n"
                    ."<td><label for='id_pwd'> Contraseña: </label><input type='password' id='id_pwd' name='s_pwd' required /></td>\n"
                    ."<td><button type='submit' value='Enviar ' >Enviar</button>\n"
              . "</tr>\n"
              . "</table>\n";
        $html .= "</form>\n";

        return $html;
    }

    function pantalla_SegundaLLamada($s_usr, $s_pwd) {
        
        $html = "Ejecutado - Usuario: " . $s_usr . "<br> - Contraseña: " . $s_pwd;

        return $html;
    }

    function lee_usuarios($archivo_txt) {
        //lee contenido de archivo txt
        $usr_contenido = file_get_contents($archivo_txt);
//        $usr_contenido = file_get_contents('files/usuarios.txt');

        // se retira último ";" a final 
        $usr_contenido = trim($usr_contenido);
        $usr_contenido = rtrim($usr_contenido, ';');

        if (empty($usr_contenido)) {
            return [];
        }

        $blq_usuarios = explode(';', $usr_contenido);
        $arr_usuarios = [];

        foreach ($blq_usuarios as $blq_usuario) {
            $blq_usuario = trim($blq_usuario);
            if ($blq_usuario === '') {
                continue;
            }            

            $datos_usr = explode(',', $blq_usuario);
            if (count($datos_usr) >= 2) {
                $usr_name = trim($datos_usr[0]);
                $usr_pwd  = trim($datos_usr[1]);
                
                $arr_usuarios[$usr_name] = $usr_pwd;
            }

// Aqui no me aseguro de que cada bloque traiga al menos dos datos (usr y pwd)
//            list($usr_name, $usr_pwd) = explode(',', $blq_usuario);
//            $arr_usuarios[$usr_name] = $usr_pwd;
        }

        return $arr_usuarios;
    }

    function muestra_usuario($nombre_archivo) {

        $usuarios = lee_usuarios($nombre_archivo);


        $tabla_suarios = "<table>\n"
            ."<head>\n"
                ."<tr>\n"
                    ."<td>Usuario</td>\n"
                    ."<td>Password</td>\n"
                . "</tr>\n"
            ."</head>\n"
            ."<tbody>\n";

        foreach ($usuarios as $usuario => $clave) {
            $tabla_suarios .= "<tr>\n"
                ."<td><label> $usuario</label></td>\n"
                ."<td><label> $clave</label></td>\n"
            . "</tr>\n";
        }
        $tabla_suarios .= "</tbody>\n"
            . "</table>\n";

        return $tabla_suarios;
    }

    function registra_usuario($s_usr, $s_pwd, $s_archivo) {

        $datos_usuario = [$s_usr, $s_pwd];

        // formatea registro
        $linea_datos = implode(',', $datos_usuario) . ";";

        // Agregamos al archivo texto de usuarios
        file_put_contents($s_archivo, $linea_datos, FILE_APPEND);
    }

    function valida_usuario($s_usuario, $s_password) {

    /*
        $usuarios = [
            "usuario01" => "111usuario",
            "usuario02" => "222usuario",
            "usuario03" => "333usuario"
        ];  
    */
        $usuarios = lee_usuarios('files/usuarios.txt');

        $pwd_verdadero = null;
        $pwd_digitado = $s_password;
        $result = 0; // el usuario no existe

        foreach ($usuarios as $usuario => $clave) {
            if ($usuario === $s_usuario) {
                $pwd_verdadero = $clave;
                break; // Detiene el bucle una vez que lo encuentra
            }
        }

        if ($pwd_verdadero === null) {
                $result = 0; // usuario no existe
        } else {
            if ($pwd_digitado === $pwd_verdadero) {
                $result = 1; // contraseña correcta
            } else {
                $result = 2; // contraseña incorrecta
            }
        }

        return $result;
    }
            

?>
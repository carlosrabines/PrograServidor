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

    function valida_usuario($s_usuario, $s_password) {

        $usuarios = [
            "usuario01" => "111usuario",
            "usuario02" => "222usuario",
            "usuario03" => "333usuario"
        ];  

        $pwd_verdadero = null;
        $pwd_digitado = $s_password;
        $result = 0; // el usuario no existe

        foreach ($usuarios as $usuario => $clave) {
            if ($usuario === $s_usuario) {
                $pwd_verdadero = $clave;
                break; // Detiene el bucle una vez que lo encuentra
            }
        }

        // 3. Mostrar el resultado
        if ($pwd_digitado === $pwd_verdadero) {
            $result = 1; // contraseña correcta
        } else {
            $result = 2; // contraseña incorrecta
        }

        return $result;
    }
            

?>
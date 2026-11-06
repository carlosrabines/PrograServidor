<?php

    //Funcion que arma el html pantalla inicial
    function pantalla_inicio() {

        //Para dejar por defecto marcados un color y un idioma en inicio
        $celeste_checked = "checked";
        $esp_checked = "checked";
        $rosa_checked = $eng_checked = $fra_checked = "";

        $html = "<h1>Ejercicio cookies - Idioma, color y CV</h1>"
        ."<form action='introducir_cv.php' method='POST'>\n"
            ."<div class='contenedor'>\n"
                ."<fieldset  class='radio-grupo'>\n"
                ."<legend>Color de Fondo:</legend>\n"
                    ."<label class='radio-opcion' ><input type='radio' name='rd_color' value='celeste' required " . $celeste_checked . "/> Celeste</label><br>\n"
                    ."<label class='radio-opcion' ><input type='radio' name='rd_color' value='rosa' required " . $rosa_checked . "/> Rosa</label><br>\n"
                ."</fieldset><br>\n"
                ."<fieldset  class='radio-grupo'>\n"
                ."<legend>Idioma:</legend>\n"
                    ."<label class='radio-opcion' ><input type='radio' name='rd_idioma' value='espanol' required " . $esp_checked . "/> Español</label><br>\n"
                    ."<label class='radio-opcion' ><input type='radio' name='rd_idioma' value='ingles' required " . $eng_checked . "/> Ingles</label><br>\n"
                    ."<label class='radio-opcion' ><input type='radio' name='rd_idioma' value='frances' required " . $fra_checked . "/> Frances</label><br>\n"
                ."</fieldset><br>\n"
                ."<button type='submit' class='botones-izquierda' name='accion' value='Introducir_cv'>Introducir_cv</button>\n"
            ."</div>\n"
        . "</form>\n";

        return $html;
    }

    //Funcion que valida la preselcción de color e idioma
    function validaPreferenciasElegidas($colores, $idiomas) {
        if (isset($_POST['rd_color'], $_POST['rd_idioma'])) {
            // Valida si estan los elementos 'rd_color' y 'rd_idioma' y los asigna a variables
            $colorElegido = $_POST['rd_color'];
            $idiomaElegido = $_POST['rd_idioma'];
        } elseif (isset($_POST['color'], $_POST['lang'])) {
            // Valida si estan los elementos 'color' e 'lang' y los asigna a variables
            $colorElegido = $_POST['color'];
            $idiomaElegido = $_POST['lang'];
        } elseif (isset($_COOKIE['set_color'], $_COOKIE['set_idioma'])) {
            // Valida si hay cookie con los elementos 'set_color' y 'set_idioma' y los asigna a variables
            $colorElegido = $_COOKIE['set_color'];
            $idiomaElegido = $_COOKIE['set_idioma'];
        } else {
            return false;
        }

        /* 
            Valida si se asignaron variables de seleccion de color e idiomna y
            también valida que los valores asignados sean válidos
        */
        if (!is_string($colorElegido) || !isset($colores[$colorElegido])
            || !is_string($idiomaElegido) || !isset($idiomas[$idiomaElegido])) {
            return false;
        }

        return [
            'colorElegido' => $colorElegido,
            'idiomaElegido' => $idiomaElegido,
        ];
    }

    // Genera el html Introducir_cv con los datos del idioma elegido 
    function presentacion_cv($dataIdioma) {
        $html = "<main class='cv-contenedor'>\n"
            ."<h1>" . htmlspecialchars($dataIdioma['title_cv'], ENT_QUOTES, 'UTF-8') . "</h1>\n"
            ."<form class='cv-formulario' action='' method='POST'>\n"
                ."<p>\n"
                    ."<label for='name'>" . htmlspecialchars($dataIdioma['name'], ENT_QUOTES, 'UTF-8') . "</label>\n"
                    ."<input type='text' id='name' name='name' required>\n"
                ."</p>\n"
                ."<p>\n"
                    ."<label for='email'>" . htmlspecialchars($dataIdioma['email'], ENT_QUOTES, 'UTF-8') . "</label>\n"
                    ."<input type='email' id='email' name='email' required>\n"
                ."</p>\n"
                ."<p>\n"
                    ."<label for='education'>" . htmlspecialchars($dataIdioma['education'], ENT_QUOTES, 'UTF-8') . "</label>\n"
                    ."<textarea id='education' name='education' rows='4'></textarea>\n"
                ."</p>\n"
                ."<p>\n"
                    ."<label for='experience'>" . htmlspecialchars($dataIdioma['experience'], ENT_QUOTES, 'UTF-8') . "</label>\n"
                    ."<textarea id='experience' name='experience' rows='4'></textarea>\n"
                ."</p>\n"
                ."<button type='submit' class='botones-izquierda'>"
                    .htmlspecialchars($dataIdioma['submit_cv'], ENT_QUOTES, 'UTF-8')
                ."</button>\n"
            ."</form>\n"
            /*
                Se egregó enlace para volver a definir las preferencias de color e idionma,
                si bien no se solicita, pero quería probar como hacerlo.
            */
            ."<a class='cv-enlace-reset' href='introducir_cv.php?action=reset'>"
                .htmlspecialchars($dataIdioma['reset_choise'], ENT_QUOTES, 'UTF-8')
            ."</a>\n"
        ."</main>\n";

        return $html;
    }

?>
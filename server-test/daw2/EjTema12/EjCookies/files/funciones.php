<?php

    function pantalla_inicio() {

        $html = "<h1>Ejercicio teórico cookies</h1>"
        ."<form action='{$_SERVER['PHP_SELF']}' method='POST' >\n"
            ."<p>Se enviaro las cookies </p>\n"
        . "</form>\n";

        return $html;
    }

?>
<?php
    require_once dirname(__DIR__) . '/MiCabecera.php';
    require_once dirname(__DIR__) . '/Customer.php';
    require_once dirname(__DIR__) . '/Book.php';

    function escape_html(string $valor): string
    {
        return htmlspecialchars($valor, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }

    function visualiza_datos(int $tipo_visualiza): string {

        $customers = [
            new Customer(1, 'Lucía', 'García Pérez', 'lucia.garcia@example.com'),
            new Customer(2, 'Carlos', 'Rabines Torres', 'carlos.rabines@example.com'),
            new Customer(3, 'Marina', 'López Ruiz', 'marina.lopez@example.com'),
        ];

        $books = [
            new Book(1, 'El principito', 'Antoine de Saint-Exupéry', '978-84-206-4892-5', 12.50),
            new Book(2, 'Cien años de soledad', 'Gabriel García Márquez', '978-84-397-2499-8', 18.95),
            new Book(3, 'La sombra del viento', 'Carlos Ruiz Zafón', '978-84-080-4353-1', 21.00),
        ];


        $cabecera = new MiCabecera(
                                    'Clientes y libros',
                                    'Datos almacenados en las clases Customer y Libro'
                                  );

        $html_customer = "<section>\n"
                ."<h2>Clientes</h2>\n"
                ."<table>\n"
                    ."<thead>\n"
                        ."<tr>\n";

        if ($tipo_visualiza === 1) {
            $html_customer .= "<th>ID</th>\n"
                            ."<th>Nombre</th>\n"
                            ."<th>Apellidos</th>\n"
                            ."<th>Correo</th>\n";
        } else {
            $html_customer .= "<th>Datos de Clientes</th>\n";
        }
                        
       $html_customer .= "</tr>\n"
                    ."</thead>\n"
                ."<tbody>\n";

        foreach ($customers as $customer) {

            $html_customer .= "<tr>\n";

            if ($tipo_visualiza === 1) {
                $idCustomer = escape_html((string) $customer->getIdCustomer());
                $fisrtname = escape_html($customer->getFirstname());
                $lastname = escape_html($customer->getLastname());
                $email = escape_html($customer->getEmail());
                
                $html_customer .= "<td>$idCustomer</td>\n"
                                ."<td>$fisrtname</td>\n"
                                ."<td>$lastname</td>\n"
                                ."<td>$email</td>\n";
            } else {
                $tostring_customer = (string) $customer;
                $html_customer .= "<td>$tostring_customer</td>\n";
            }

            $html_customer .= "</tr>\n";

        }

        $html_customer .= "</tbody>\n"
                        . "</table>\n"
                    ."</section>\n";

        $html_book = "<section>\n"
                    ."<h2>Libros</h2>\n"
                    ."<table>\n"
                        ."<thead>\n"
                            ."<tr>\n";

        if ($tipo_visualiza === 1) {
            $html_book .= "<th>ID</th>\n"
                        ."<th>Título</th>\n"
                        ."<th>Autor</th>\n"
                        ."<th>ISBN</th>\n"
                        ."<th>Precio</th>\n";
        } else {
            $html_book .= "<th>Datos de Libros</th>\n";
        }

        $html_book .= "</tr>\n"
                    ."</thead>\n"
                ."<tbody>\n";

        foreach ($books as $book) {
            $bookId = escape_html((string) $book->getIdBook());
            $bookTitle = escape_html($book->getTitle());
            $bookAuthor = escape_html($book->getAuthor());
            $bookIsbn = escape_html($book->getIsbn());
            $bookPrice = number_format($book->getPrice(), 2, ',', '.');

            $html_book .= "<tr>\n";

            if ($tipo_visualiza === 1) {
                $html_book .= "<td>$bookId</td>\n"
                            ."<td>$bookTitle</td>\n"
                            ."<td>$bookAuthor</td>\n"
                            ."<td>$bookIsbn</td>\n"
                            ."<td>$bookPrice</td>\n";
            } else {
                $tostring_book = (string) $book;
                $html_book .= "<td>$tostring_book</td>\n";
            }            

            $html_book .= "</tr>\n";
        }

        $html_book .= "</tbody>\n"
                    . "</table>\n"
                ."</section>\n";

       $html = $cabecera
            ."<main>\n"
            . $html_customer
            . $html_book
            ."<p><a href='index.php'>Volver al inicio</a></p>\n"
        ."</main>\n";

      return $html;
    }

    function escape_html(string $valor): string
    {
        return htmlspecialchars($valor, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
    }

    function validar_usuario(string $usuario, string $clave): bool
    {
        $usuarios = [
            'ana' => '1234',
            'luis' => 'monte2026',
            'admin' => 'admin2026',
        ];

        return isset($usuarios[$usuario])
            && hash_equals($usuarios[$usuario], $clave);
    }

    function dni_es_valido(string $dni): bool
    {
        $dni = strtoupper(trim($dni));
        $dni = str_replace([' ', '-'], '', $dni);

        if (!preg_match('/^[0-9]{8}[A-Z]$/', $dni)) {
            return false;
        }

        $letras = 'TRWAGMYFPDXBNJZSQVHLCKE';
        $numero = (int) substr($dni, 0, 8);
        $letraCorrecta = $letras[$numero % 23];

        return substr($dni, 8, 1) === $letraCorrecta;
    }

    function ciudad_europea(string $ciudad): bool
    {
        $ciudadesEuropeas = [
            'madrid', 'barcelona', 'valencia', 'sevilla', 'bilbao',
            'zaragoza', 'malaga', 'murcia', 'palma', 'lisboa', 'porto',
            'paris', 'lyon', 'marsella', 'londres', 'manchester',
            'berlin', 'munich', 'hamburgo', 'roma', 'milán', 'milano',
            'napoles', 'napoli', 'viena', 'vienna', 'amsterdam',
            'bruselas', 'brussels', 'praga', 'prague', 'varsovia',
            'warsaw', 'dublin', 'oslo', 'estocolmo', 'stockholm',
            'copenhague', 'copenhagen', 'atenas', 'athens',
            'budapest', 'bucarest', 'bucharest', 'sofia', 'zagreb',
            'liubliana', 'ljubljana', 'bratislava', 'tallin', 'tallinn',
            'riga', 'vilna', 'vilnius', 'helsinki', 'zurich', 'zúrich',
            'ginebra', 'geneva', 'monaco', 'mónaco',
            'andorra la vella', 'reikiavik', 'reykjavik',
            'la valeta', 'valletta', 'luxemburgo', 'luxembourg',
            'sarajevo', 'belgrado', 'belgrade', 'podgorica',
            'tirana', 'skopje', 'chisinau', 'kiev', 'kyiv',
            'moscu', 'moscow'
        ];

        $ciudad = trim($ciudad);
        $ciudadNormalizada = function_exists('mb_strtolower')
            ? mb_strtolower($ciudad, 'UTF-8')
            : strtolower($ciudad);

        $transliterada = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $ciudadNormalizada);
        if (is_string($transliterada) && $transliterada !== '') {
            $ciudadNormalizada = strtolower($transliterada);
        }

        return in_array($ciudadNormalizada, $ciudadesEuropeas, true);
    }

    function usuario_autenticado(): bool
    {
        return isset($_SESSION['cod_usuario'])
            && is_string($_SESSION['cod_usuario'])
            && $_SESSION['cod_usuario'] !== '';
    }

    function pantalla_login(string $error = ''): string
    {
        $errorHtml = $error !== ''
            ? "<p class='error'>" . escape_html($error) . "</p>\n"
            : '';

        return "<h1>Acceso a la aplicación</h1>\n"
            . "<form action='index.php' method='POST'>\n"
            . "<div class='contenedor'>\n"
            . "<p><label for='id_usuario'>Usuario:</label>\n"
            . "<input type='text' id='id_usuario' name='s_usuario' required></p>\n"
            . "<p><label for='id_clave'>Clave:</label>\n"
            . "<input type='password' id='id_clave' name='s_clave' required></p>\n"
            . $errorHtml
            . "<button type='submit' class='botones'>Entrar</button>\n"
            . "</div>\n"
            . "</form>\n";
    }

    function pantalla_opciones(): string
    {
        return "<h1>Opciones</h1>\n"
            . "<nav>\n"
            . "<ul>\n"
            . "<li><a href='index.php?reiniciar=1'>Reiniciar sesión</a></li>\n"
            . "<li><a href='ingreso_datos.php'>Ingresar datos</a></li>\n"
            . "<li><a href='visualizar_registros.php'>Visualizar registros</a></li>\n"
            . "</ul>\n"
            . "</nav>\n";
    }

    function clase_invalida(array $errores, string $campo): string
    {
        return isset($errores[$campo]) ? " class='invalido'" : '';
    }

    function pantalla_ingreso(array $datos = [], array $errores = [], string $mensaje = ''): string
    {
        $dni = escape_html($datos['dni'] ?? '');
        $nombre = escape_html($datos['nombre'] ?? '');
        $apellidos = escape_html($datos['apellidos'] ?? '');
        $correo = escape_html($datos['correo'] ?? '');
        $ciudad = escape_html($datos['ciudad'] ?? '');
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

        return "<h1>Ingreso de datos</h1>\n"
            . $mensajeHtml
            . $erroresHtml
            . "<form action='ingreso_datos.php' method='POST'>\n"
            . "<table>\n"
            . "<tr><td><label for='dni'>DNI:</label></td><td><input type='text' id='dni' name='dni' value='$dni'"
            . clase_invalida($errores, 'dni') . "></td></tr>\n"
            . "<tr><td><label for='nombre'>Nombre:</label></td><td><input type='text' id='nombre' name='nombre' value='$nombre'"
            . clase_invalida($errores, 'nombre') . "></td></tr>\n"
            . "<tr><td><label for='apellidos'>Apellidos:</label></td><td><input type='text' id='apellidos' name='apellidos' value='$apellidos'"
            . clase_invalida($errores, 'apellidos') . "></td></tr>\n"
            . "<tr><td><label for='correo'>Correo:</label></td><td><input type='email' id='correo' name='correo' value='$correo'"
            . clase_invalida($errores, 'correo') . "></td></tr>\n"
            . "<tr><td><label for='ciudad'>Ciudad:</label></td><td><input type='text' id='ciudad' name='ciudad' value='$ciudad'"
            . clase_invalida($errores, 'ciudad') . "></td></tr>\n"
            . "<tr><td><label for='pais'>País:</label></td><td><input type='text' id='pais' name='pais' value='$pais'"
            . clase_invalida($errores, 'pais') . "></td></tr>\n"
            . "</table>\n"
            . "<button type='submit' class='botones'>Guardar registro</button>\n"
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
                . "<thead><tr><th>DNI</th><th>Nombre</th><th>Apellidos</th>"
                . "<th>Correo</th><th>Ciudad</th><th>País</th></tr></thead>\n"
                . "<tbody>\n";

            foreach ($registros as $dni => $registro) {
                $html .= "<tr>\n"
                    . "<td>" . escape_html((string) $dni) . "</td>\n"
                    . "<td>" . escape_html((string) ($registro['nombre'] ?? '')) . "</td>\n"
                    . "<td>" . escape_html((string) ($registro['apellidos'] ?? '')) . "</td>\n"
                    . "<td>" . escape_html((string) ($registro['correo'] ?? '')) . "</td>\n"
                    . "<td>" . escape_html((string) ($registro['ciudad'] ?? '')) . "</td>\n"
                    . "<td>" . escape_html((string) ($registro['pais'] ?? '')) . "</td>\n"
                    . "</tr>\n";
            }

            $html .= "</tbody>\n</table>\n";
        }

        $html .= "<p><a href='ingreso_datos.php'>Realizar un nuevo registro</a></p>\n"
            . "<p><a href='opciones.php'>Volver a opciones</a></p>\n";

        return $html;
    }

?>
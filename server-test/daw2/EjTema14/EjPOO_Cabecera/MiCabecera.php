<?php

    class MiCabecera
    {
        private string $titulo;
        private string $subtitulo;

        public function __construct(string $titulo, string $subtitulo = '')
        {
            $this->titulo = $titulo;
            $this->subtitulo = $subtitulo;
        }

        public function __toString(): string
        {
            $titulo = htmlspecialchars($this->titulo, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
            $html = "<header>\n    <h1>{$titulo}</h1>\n";

            if ($this->subtitulo !== '') {
                $subtitulo = htmlspecialchars($this->subtitulo, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
                $html .= "    <h2>{$subtitulo}</h2>\n";
            }

            return $html . "</header>\n";
        }
    }
?>
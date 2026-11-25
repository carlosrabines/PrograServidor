<?php

class Book
{
    private int $idBook;
    private string $title;
    private string $author;
    private string $isbn;
    private float $price;

    public function __construct(int $idBook, string $title, string $author, string $isbn
                              , float $price) {
        $this->idBook = $idBook;
        $this->title = $title;
        $this->author = $author;
        $this->isbn = $isbn;
        $this->price = $price;
    }

    public function __toString(): string {
        return "Id Libro: " . (string) $this->idBook . ", Titulo: {$this->title}, "
             . "Autor: {$this->author}, ISBN: {$this->isbn}, "
             . "Precio: " . number_format($this->price, 2, ',', '.');
    }    

    public function getIdBook(): int {
        return $this->idBook;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function getAuthor(): string {
        return $this->author;
    }

    public function getIsbn(): string {
        return $this->isbn;
    }

    public function getPrice(): float {
        return $this->price;
    }
}

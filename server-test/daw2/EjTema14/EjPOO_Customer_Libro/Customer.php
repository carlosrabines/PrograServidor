<?php

class Customer
{
    private int $idCustomer;
    private string $firstname;
    private string $lastname;
    private string $email;

    public function __construct(int $idCustomer, string $firstname, string $lastname, string $email) {
        $this->idCustomer = $idCustomer;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
    }

    public function __toString(): string {
        return "Nombre: {$this->firstname}, Apelido: ({$this->lastname}), "
             . "e-mail: {$this->email}";
    }

    public function getIdCustomer(): int {
        return $this->idCustomer;
    }

    public function getFirstname(): string {
        return $this->firstname;
    }

    public function getLastname(): string {
        return $this->lastname;
    }

    public function getEmail(): string {
        return $this->email;
    }
}

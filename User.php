<?php

class User
{
    protected $naam;
    protected $voornaam;
    protected $admin;
    protected $geldPotje;
    protected $email;

    function __construct(string $naam, string $voornaam, bool $admin, float $geldPotje, string $email)
    {
        $this->naam = $naam;
        $this->email = $email;
        $this->password = $password;
        $this->voornaam = $voornaam;
        $this->geldPotje = $geldPotje;
    }

    public function getNaam() : string
    {
        return $this->naam;
    }

    public function getEmail() : string
    {
        return $this->email;
    }

    /*public function isValidLogin(string $email, string $password) : bool
    {
        if($email === $this->email && $password === $this->password) {
            return true;
        }
        return false;
    }*/

    public function getVoornaam() : string
    {
        return $this->voornaam;
    }

    public function getGeldPotje() : float
    {
        return $this->geldPotje;
    }
}

?>
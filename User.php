<?php

class User
{
    //protected $userName;
    protected $naam;
    protected $voornaam;
    protected $admin;
    protected $geldPotje;
    protected $email;
    //protected $password;

    function __construct(string $naam, string $voornaam, bool $admin, int $geldPotje, string $email)
    {
        $this->naam = $naam;
        $this->email = $email;
        $this->password = $password;
        $this->voornaam = $voornaam;
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
}

?>
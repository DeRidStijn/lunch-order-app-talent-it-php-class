<?php

class Persoon
{

    public $naam;
    public $voornaam;
    public $email;
    // public $potje;

    function __construct(string $naam, string $voornaam) //nieuwe persoon aanmaken 
    {
        $this->naam = $naam;
        $this->voornaam = $voornaam;
        // $this->potje = $potje;
    }

    /*public function updatePotje($bedrag) // bij het kopen van een broodje of geld bijzetten op het potje
    {
        $potje += $bedrag;
        return $potje;
    }*/

    public function getNaam ()
    {
        return $naam;
    }
    public function getVoornaam()
    {
        return $voornaam;
    }
    /*public function getPotje()
    {
        return '€' . $potje;
    }*/

}

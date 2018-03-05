<?php

class Brood
{
    protected $smos;
    protected $fitness;
    protected $typeBeleg;
    protected $baguette;
    protected $aantalBroodjes;

    function __construct(bool $smos, bool $fitness, string $typeBeleg, bool $baguette, int $aantalBroodjes)
    {
        $this->smos = $smos;
        $this->fitness = $fitness;
        $this->typeBeleg = $typeBeleg;
        $this->baguette = $baguette;
        $this->aantalBroodjes = $aantalBroodjes;
    }
    
    function getSmos() : bool
    {
        return $this->smos;
    }

    function getFitness() : bool
    {
        return $this->fitness;
    }

    function getTypeBeleg() : string
    {
        return $this->typeBeleg;
    }

    function getBaguette() : bool
    {
        return $this->baguette;
    }

    function getAantalBroodjes() : int 

    {
        return $this->aantalBroodjes;
    }
}
 

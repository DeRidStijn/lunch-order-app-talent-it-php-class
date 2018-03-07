<?php

class Brood
{
    protected $smos;
    protected $fitness;
    protected $typeBeleg;
    protected $baguette;
    protected $aantalBroodjes;
    protected $opmerking;

    function __construct(bool $smos, bool $fitness, int $typeBeleg, bool $baguette, int $aantalBroodjes, string $opmerking)
    {
        $this->smos = $smos;
        $this->fitness = $fitness;
        $this->typeBeleg = $typeBeleg;
        $this->baguette = $baguette;
        $this->aantalBroodjes = $aantalBroodjes;
        $this->opmerking = $opmerking;
    }
    
    public function getSmos() : bool
    {
        return $this->smos;
    }

    public function getFitness() : bool
    {
        return $this->fitness;
    }

    public function getTypeBeleg() : int
    {
        return $this->typeBeleg;
    }

    public function getBaguette() : bool
    {
        return $this->baguette;
    }

    public function getAantalBroodjes() : int 

    {
        return $this->aantalBroodjes;
    }

    public function getOpmerking() : string
    {
        return $this->opmerking;
    }
}
 


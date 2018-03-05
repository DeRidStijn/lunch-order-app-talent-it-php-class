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
    
    public function getSmos() : bool
    {
        return $this->smos;
    }

    public function getFitness() : bool
    {
        return $this->fitness;
    }

    public function getTypeBeleg() : string
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
}
 


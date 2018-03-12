<?php
require_once('Supplement.php');

class Brood
{
    protected $smos;
    protected $fitness;
    protected $typeBeleg;
    protected $baguette;
    protected $aantalBroodjes;
    protected $opmerking;
    protected $supplement;

    function __construct(bool $smos, bool $fitness, int $typeBeleg, bool $baguette, int $aantalBroodjes, string $opmerking, Supplement $supplement)
    {
        $this->smos = $smos;
        $this->fitness = $fitness;
        $this->typeBeleg = $typeBeleg;
        $this->baguette = $baguette;
        $this->aantalBroodjes = $aantalBroodjes;
        $this->supplement = $supplement;
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

    function getSupplement() : int
    {
        return $this->supplement;
    }
}
 


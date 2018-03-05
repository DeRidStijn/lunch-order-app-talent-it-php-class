<?php

class Brood
{
    protected $smos;
    protected $fitness;
    protected $typeBeleg;
    protected $baguette;

    function __construct(bool $smos, bool $fitness, string $typeBeleg, bool $baguette)
    {
        $this->smos = $smos;
        $this->fitness = $fitness;
        $this->typeBeleg = $typeBeleg;
        $this->baguette = $baguette;
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
}


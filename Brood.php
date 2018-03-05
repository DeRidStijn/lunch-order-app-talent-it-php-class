<?php

class Broodje
{
    protected $smos;
    protected $fitness;
    protected $typeBeleg;
    protected $baguette;

    function __construct(bool $smos, bool $fitness, string $typeBeleg, bool $baguette)
    {
        $this->soms = $smos;
        $this->fitness = $fitness;
        $this->typeBeleg = $typeBeleg;
        $this->baguette = $baguette;
    }
    
    function addSmos() : bool
    {
        $this->smos;
    }

    function addFitness() : bool
    {
        $this->fitness;
    }

    function addTypeBeleg() : string
    {
        $this->typeBeleg;
    }

    function addBaguette() : bool
    {
        $this->baguette;
    }
}


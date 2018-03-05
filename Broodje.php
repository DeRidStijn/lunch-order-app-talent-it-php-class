<?php

class Broodje
{
    protected $smos;
    protected $fitness;
    protected $typeBeleg;
    protected $baguette;

    function __construct(bool $smos, bool $soep, bool $fitness, string $typeBeleg, bool $baguette)
    {
        $this->soms = $smos;
        $this->soep = $soep;
        $this->fitness = $fitness;
        $this->typeBeleg = $typeBeleg;
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


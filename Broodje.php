<?php

class Broodje
{
    protected $smos;
    protected $soep;
    protected $fitness;
    protected $typeBeleg;

    function __construct(bool $smos, bool $soep, bool $fitness, string $typeBeleg)
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

    function addSoep() : bool
    {
        $this->soep;
    }

    function addFitness() : bool
    {

        $this->fitness;
    }

    function addTypeBeleg() : string
    {
        $this->typeBeleg;

    }


}


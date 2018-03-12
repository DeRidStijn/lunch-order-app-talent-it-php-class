<?php

    class Order {
        protected $naam;
        protected $soep;
        protected $broodjes;
        protected $soepBroodWit;


        function __construct(string $naam, bool $soep, array $broodjes, bool $soepBroodWit) {
            $this->naam = $naam;
            $this->soep = $soep;
            $this->broodjes = $broodjes;
            $this->soepBroodWit = $soepBroodWit;
        }

        function getSoep() : bool
        {
            return $this->soep;
        }
        function getBroodjes() : array
        {
            return $this->broodjes;
        }

        function getNaam() : string 
        {
            return $this->naam;
        }

        function getSoepBrood() : bool 
        {
            return $this->soepBroodWit;
        }

        
        
    }


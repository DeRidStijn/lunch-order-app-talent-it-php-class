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

        function getSoep() {
            return $this->soep;
        }
        function getBroodjes() {
            return $this->broodjes;
        }

        function getNaam() {
            return $this->naam;
        }

        function getSoepBrood() {
            return $this->soepBroodWit;
        }
        
    }


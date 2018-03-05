<?php

    class Order {
        protected $naam = '';
        protected $soep = false;
        protected $broodjes = [];


        function __construct(string $naam, bool $soep, array $broodjes) {
            $this->naam = $naam;
            $this->soep = $soep;
            $this->broodjes = $broodjes;
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
    }


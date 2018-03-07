<?php

class Supplement {
    protected $prijs;
    protected $supplement;

    function __construct(float $prijs, string $supplement) 
    {
        $this->prijs = $prijs;
        $this->supplement = $supplement;
    }

    function getSupplement() {
        return $supplement;
    }
    function getPrijs() {
        return $prijs;
    }

}

?>
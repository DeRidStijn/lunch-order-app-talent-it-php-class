<?php

class Supplement {
    protected $prijs;
    protected $supplement;

    function __construct(float $prijs, string $supplement) 
    {
        $this->prijs = $prijs;
        $this->supplement = $supplement;
    }

    public function getSupplement() : string
    {
        return $supplement;
    }

    public function getPrijs() : float 
    {
        return $prijs;
    }

}

?>
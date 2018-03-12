<?php

class Supplement {
    protected $prijs;
    protected $supplement;

    function __construct(float $prijs, int $supplement) 
    {
        $this->prijs = $prijs;
        $this->supplement = $supplement;
    }

    public function getSupplement() : int
    {
        return $supplement;
    }

    public function getPrijs() : float 
    {
        return $prijs;
    }

}

?>
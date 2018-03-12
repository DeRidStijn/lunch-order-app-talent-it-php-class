<?php

class Supplement
{
    //protected $prijs;
    protected $supplement;

    function __construct(int $supplement) 
    {
        $this->supplement = $supplement;
    }

    public function getSupplement() : int
    {
        return $this->supplement;
    }
}

?>
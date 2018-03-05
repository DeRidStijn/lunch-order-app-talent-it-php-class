<?php
class Sessionhandler{

    function __construct(string $sessionId) //nieuwe persoon aanmaken 
    {
        session_id($sessionId);
    }

    public function fillBestelling(bool $isSmos, bool $isFitness, string $typeBeleg, bool $isBaguette, string $naam)
    {
        $_SESSION['bestelling']['isSmos'] = $isSmos;
        $_SESSION['bestelling']['isFitness'] = $isFitness;
        $_SESSION['bestelling']['typeBeleg'] = $typeBeleg;
        $_SESSION['bestelling']['isBaguette'] = $isBaguette;
        $_SESSION['bestelling']['naam'] = $naam;
        header('index.php');
    }



} 
/*
    sessie voor bestelde broodjes + gegevens persoon
*/

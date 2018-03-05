<?php
/* deze klasse wordt niet gebruikt wegens het gebruik van $_SESSION */

class Sessionhandler extends Order{
protected $order;
    function __construct(string $sessionId) //nieuwe persoon aanmaken 
    {
        session_id($sessionId);
        $this->order = new Order();
    }

    public function setOrder(Order $myOrder)
    {
        $this->order = $myOrder;
        $_SESSION['order'] = $this->order;
    }

    public function setError(array $errormessage = [])
    {
        $_SESSION['errors'][]= $errormessage;
    }
    public function clearErrors()
    {
        $_SESSION['errors'] = [];
    }
    public function getOrder()
    {

    }
} 

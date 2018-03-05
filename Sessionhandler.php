<?php
class Sessionhandler{

    function __construct(string $sessionId)
    {
        session_id($sessionId);
    }

} 


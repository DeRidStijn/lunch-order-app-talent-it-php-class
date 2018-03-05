<?php

    class CookieHandler extends SessionHandler {

        public function __construct() {
            if (!isset($_COOKIE[$this->session_id])) {
                return setcookie($this->session_id);
                session_save_path(['/Server/']);
            } else {
                open($this->session_id);
            }
         }
    }


    

    
    


    

    
    //user / broodjes besteld 

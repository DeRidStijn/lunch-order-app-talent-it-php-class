<?php

    class Cookie {
        
        private $name = false;
        public $user = '';

        public function __construct() { }


        public function create() {
            return setcookie($this->name, $this->user);
        }

        public function get(){
            return $this;
        }

        public function delete(){
            return setcookie($this->name, '');
        }

        public function setName($id) {
            $this->name = $id;
        }
        public function getName() {
            return $this->name;
        }

        public function setValue() {
            return $this->user;
        }

    }


    

    
    


    

    
    //user / broodjes besteld 

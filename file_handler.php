<?php

require_once('Order.php');
require_once('Brood.php');


class FileHandler {
    protected $orderInfo;
    protected $file_name;

    
    public function __construct(Order $order) {
        $this->orderInfo = $order;
        $this->file_name = 'order.txt';
    }

    public function getOrderInfo(){
        return $this->orderInfo;
    }

    public function create(){

        //if the file exists, append to the file, if not, create new file

        //ERROR -- text gets put to .txt files TWICE per reload (maybe cause reload)

        if (file_exists($this->file_name)) {
            file_put_contents($this->file_name, json_encode($this->orderInfo), FILE_APPEND);
        } else {
            file_put_contents($this->file_name, $this->orderInfo);
        }
    }

}

//$fileHandler = new FileHandler(date('l jS \of F Y h:i:s A') . $myOrder . "\r\n");
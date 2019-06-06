<?php

namespace CardTool;

class BankInfo{

    public $is_exists = false;
    public $card_name = "";
    public $bank_name= "";
    public $type = 4;
    public $color = "#FFFFFF";
    public $bank_image = "";

    public function __construct(array $data)
    {
        if(!empty($data)){
            $this->is_exists = true;
            $this->card_name = $data["name"];
            $this->bank_name = $data["bank_info"]["bank_name"];
            $this->type = $data["type"];
            $this->color = $data["bank_info"]["color"];
            $this->bank_image = $data["bank_info"]["bank_image"];
        }
    }

    public function isExists(){
        return $this->is_exists;
    }
    public function getCardName(){
        return $this->card_name;
    }
    public function getBankName(){
        return $this->bank_name;
    }
    public function getType(){
        return $this->type;
    }
    public function getColor(){
        return $this->color;
    }
    public function getBankImage(){
        return $this->bank_image;
    }
}
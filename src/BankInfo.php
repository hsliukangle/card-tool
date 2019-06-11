<?php

namespace CardTool;

class BankInfo
{

    private $is_exists = false;  //是否存在
    private $card_name = "";     //卡名称
    private $bank_name = "";      //银行名称
    private $type = 4;           //卡类型
    private $color = "#FFFFFF";  //卡颜色
    private $bank_image = "";    //银行图标

    public function __construct(array $data = [])
    {
        if (!empty($data)) {
            $this->is_exists = true;
            $this->card_name = $data["name"];
            $this->bank_name = $data["bank_info"]["bank_name"];
            $this->type = $data["type"];
            $this->color = $data["bank_info"]["color"];
            $this->bank_image = $data["bank_info"]["bank_image"];
        }
    }

    public function isExists()
    {
        return $this->is_exists;
    }

    public function getCardName()
    {
        return $this->card_name;
    }

    public function getBankName()
    {
        return $this->bank_name;
    }

    public function getType()
    {
        return $this->type;
    }

    public function getColor()
    {
        //现在颜色那里是ARGB，需要转为RGB
        $hexColor = substr($this->color, 3, 6);
        $color = str_replace('#', '', $hexColor);
        if (strlen($color) > 3) {
            $rgb = [
                'r' => hexdec(substr($color, 0, 2)),
                'g' => hexdec(substr($color, 2, 2)),
                'b' => hexdec(substr($color, 4, 2))
            ];
        } else {
            $color = str_replace('#', '', $hexColor);
            $r = substr($color, 0, 1) . substr($color, 0, 1);
            $g = substr($color, 1, 1) . substr($color, 1, 1);
            $b = substr($color, 2, 1) . substr($color, 2, 1);
            $rgb = [
                'r' => hexdec($r),
                'g' => hexdec($g),
                'b' => hexdec($b)
            ];
        }
        return $rgb;
    }

    public function getBankImage()
    {
        return $this->bank_image;
    }
}
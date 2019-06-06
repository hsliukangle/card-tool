<?php

include "src\CardDb.php";
include "src\CardToolException.php";
include "src\BankInfo.php";

$card_number = "123";   //银行卡号

try {
    $cardDb = new \CardTool\CardDb();
    $bank_info = $cardDb->getBankInfo($card_number);

    $result = [
        'is_exists' => $bank_info->isExists(),
        'card_name' => $bank_info->getCardName(),
        'bank_name' => $bank_info->getBankName(),
        'type' => $bank_info->getType(),
        'color' => $bank_info->getColor(),
        'bank_image' => $bank_info->getBankImage(),
        // ... 可自己扩展
    ];

    var_export($result);

} catch (\CardTool\CardToolException $e) {
    print_r($e->getMessage());
}
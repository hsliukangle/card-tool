<?php

include "src\CardDb.php";
include "src\CardToolException.php";
include "src\BankInfo.php";

$card_number = "123";   //银行卡号

try {
    $cardDb = new \CardTool\CardDb();

    //获取银行列表
    $bankList = $cardDb->getBankList();
    //var_export($bankList);

    //获取卡的信息
    $bank_info = $cardDb->getBankInfo($card_number);

    $result = [
        'is_exists' => $bank_info->isExists(),
        'bank_id' => $bank_info->getBankId(),
        'bank_name' => $bank_info->getBankName(),
        'card_name' => $bank_info->getCardName(),
        'type' => $bank_info->getType(),
        'color' => $bank_info->getColor(),
        'bank_image' => $bank_info->getBankImage(),
        // ... 可自己扩展
    ];

    var_export($result);

} catch (\CardTool\CardToolException $e) {
    print_r($e->getMessage());
}
# card-tool
##提供一个简单识别卡号的工具类

- 只限中国卡号识别
- 目前还不够完善，但是可以应付一些识别银行卡的场景（我测了几百张银行卡，目前没有发现什么问题）
- bank-icon 目录已经准备了银行标志图片，可下载到自己项目中使用（也可以提PR一起完善它^_^）
- 准备了 识别错误日志.txt 和 遗漏日志，如果在使用中遇到什么问题，可以提PR
- 如果留下您的卡号，为了确保隐私只需要留下前8位即可
- 本工具类借鉴了国外大神的代码 <https://github.com/chekalsky/php-banks-db>，由于我的银行卡在它的项目中不能识别，重新进行了开发（其实跟它项目没什么关系了，mapping文件自己搜集的），并且功能精简了一些。
- 欢迎大家来一起完善，欢迎大家提PR，3Q

**返回示例：**

```

array (
  'is_exists' => true,
  'bank_id' => 11,
  'bank_name' => '中国光大银行',
  'card_name' => '中国光大银行-阳光卡(银联卡)-借记卡',
  'type' => '2',
  'color' =>  array (
        'r' => 247,
        'g' => 89,
        'b' => 89,
   ),
  'bank_image' => 'bank-icon/374984955211414e39231e55de47a7ff.png',
)

```

- is_exists 是否查到了银行卡信息
- card_name 卡名称
- bank_name 银行名称
- type 银行卡类型：1.信用卡 2.储蓄卡 3.预付卡 4.其他
- color 卡的颜色
- bank_image 卡的图片

## Install

```
$ composer require hsliukangle/card-tool
```

## Demo

```php
<?php

require __DIR__ . '/vendor/autoload.php';

use \CardTool\CardDb;
use \CardTool\CardToolException;

$card_number = "123";   //银行卡号

try {
    $cardDb = new CardDb();
    
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

} catch (CardToolException $e) {
    print_r($e->getMessage());
}
```

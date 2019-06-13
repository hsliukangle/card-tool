<?php

namespace CardTool;

class CardDb
{
    const FIRST_SEARCH_LENGTH = 8;
    const SECOND_SEARCH_LENGTH = 6;
    const THIRDLY_SEARCH_LENGTH = 5;
    const FOURTH_SEARCH_LENGTH = 4;

    //有的银行卡根据8位可能查不出来，需要减少位数，最低减少至4位
    const SEARCH_ORDER = [
        self::FIRST_SEARCH_LENGTH,
        self::SECOND_SEARCH_LENGTH,
        self::THIRDLY_SEARCH_LENGTH,
        self::FOURTH_SEARCH_LENGTH,
    ];

    /**
     * @var array
     */
    protected $mapping = "";

    /**
     * 初始化，可根据自己定制的传入映射表地址
     * CardDb constructor.
     * @param string|null $db_file_path
     * @throws CardToolException
     */
    public function __construct(string $db_file_path = null)
    {
        if ($db_file_path === null) {
            $db_file_path = __DIR__ . '/../mappings-db/mappings.php';
        }

        if (!is_readable($db_file_path)) {
            throw new CardToolException('Cannot find Mapping file');
        }

        $this->mapping = include $db_file_path;
    }

    /**
     * 获取银行列表
     * @return array
     */
    public function getBankList()
    {
        return array_values($this->mapping["banks"]);
    }

    /**
     * 传入银行卡号返回相关信息
     * @param string $card_number
     * @return BankInfo
     */
    public function getBankInfo(string $card_number)
    {
        $certain_bank_id = 0;
        $card_number = preg_replace('/\D/', '', $card_number);

        foreach (self::SEARCH_ORDER as $length) {
            $prefix = substr((string)$card_number, 0, $length);
            $bank_info = $this->getBankIdByPrefix($prefix);
            if ($bank_info["bank_id"] > 0) {
                $certain_bank_id = $bank_info["bank_id"];
                break;
            }
        }
        if (empty($certain_bank_id)) {
            return new BankInfo();
        }

        $bank_info["bank_info"] = $this->getBankInfoFromDatabase($certain_bank_id);
        return new BankInfo($bank_info);
    }

    /**
     * 根据传入的卡号前缀，查找是否有对应的mapping
     * @param int $prefix
     * @return array
     */
    private function getBankIdByPrefix(int $prefix)
    {
        if (isset($this->mapping["mappings"][$prefix])) {
            return (array)$this->mapping['mappings'][$prefix];
        }
    }

    /**
     * 根据银行id，返回银行详情
     * @param int $id
     * @return array
     */
    private function getBankInfoFromDatabase(int $id)
    {
        return $this->mapping['banks'][$id];
    }
}
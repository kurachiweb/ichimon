<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use App\Utilities\Validate\DbValueValidate;
use App\Utilities\Validate\IntegerValidate;

/**
 * アカウント基本ID(文字列形式での入力を含む)のバリデーション
 */
class AccountIdStringValidation implements Rule {
    /**
     * バリデーション結果
     *
     * @var true|string
     */
    private $_result = true;

    /**
     * バリデーション
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value) {
        // 整数形式の文字列か
        $this->_result = IntegerValidate::isIntegerString($value);
        if ($this->_result !== true) {
            return false;
        }
        // bigint型カラムのテーブル値形式か
        $this->_result = DbValueValidate::isPrimaryBigint((int)$value);
        if ($this->_result !== true) {
            return false;
        }
        return true;
    }

    /**
     * バリデーションエラー時のメッセージ
     *
     * @return string
     */
    public function message() {
        return get_class($this) . ' : ' . $this->_result;
    }
}

<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * テーブルの、主キー値用文字列として適切か
 */
class DbPrimaryStringValidation implements Rule {
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
        if (!isset($value)) {
            // 未定義やnullは不可
            return "Empty value.";
        }
        if (gettype($value) !== 'string') {
            // 文字列型以外は不可
            return "Not string.";
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

<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * 整数もしくは整数形式の文字列か
 */
class IntegerStringValidation implements Rule {
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
        switch (gettype($value)) {
            case 'integer':
                // 整数型の場合、可
                break;
            case 'double':
                // 浮動小数点数型の場合、不可
                return "Not integer.";
            case 'string':
                // 文字列型の場合、数字以外は不可
                if (!preg_match('/^[0-9]+$/', $value)) {
                    return "Not number string.";
                }
                break;
            default:
                // 他の型の場合、不可
                return "Not number.";
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

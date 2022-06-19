<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use App\Constants\ConstBackend;

/**
 * テーブルの、主キー値用数値として適切か
 */
class DbPrimaryNumberValidaton implements Rule {
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
        if (!is_int($value)) {
            // 整数以外は不可
            return "Not number.";
        }
        if ($value < ConstBackend::DB_TABLE_ID_MIN) {
            // 想定最小値より小さい数値は不可
            return "Less than min number.";
        }
        if (ConstBackend::DB_TABLE_ID_MAX < $value) {
            // 想定最大値より大きい数値は不可
            return "More than max number.";
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

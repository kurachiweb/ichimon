<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use App\Utilities\Validate\DbValue;

/**
 * アカウント基本IDのバリデーション
 */
class AccountIdValidation implements Rule {
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
        $this->_result = DbValue::isPrimaryBigint($value);
        return $this->_result === true;
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

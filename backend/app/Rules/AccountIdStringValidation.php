<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use App\Utilities\Validate\DbValue;

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
        // 数字以外は不可
        if (!preg_match('/^[0-9]+$/', $value)) {
          return "Not number.";
        }
        $this->_result = DbValue::isPrimaryBigint((int)$value);
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

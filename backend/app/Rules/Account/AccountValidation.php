<?php

namespace App\Rules\Account;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Validator;

/**
 * アカウント基本情報のバリデーション
 */
class AccountValidation implements Rule {
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
        // アカウント基本情報の各プロパティが対象
        $validate_by = [
            'display_id' => ['required', 'string'],
            'name' => ['required', 'string'],
            'tel_no' => ['required', 'string'],
            'address' => ['required', 'string'],
            'address_bill' => ['required', 'string'],
        ];
        $validator = Validator::make($value, $validate_by);
        if ($validator->fails()) {
            $this->_result = $validator->errors()->toJson();
            return false;
        }
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

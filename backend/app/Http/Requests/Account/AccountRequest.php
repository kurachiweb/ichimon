<?php

declare(strict_types=1);

namespace App\Http\Requests\Account;

use App\Http\Requests\RequestCommon;
use App\Rules\DbPrimaryValidation;

class AccountRequest extends RequestCommon {
    /**
     * アカウント基本情報の入力バリデーション
     *
     * @return array<string, mixed>
     */
    public function rules() {
        return [
            'account' => ['bail', 'required'],
            'account.id' => [new DbPrimaryValidation()],
            'account.display_id' => ['string']
        ];
    }

    /**
     * アカウントID形式の型違いを、正しい型に変換する
     *
     * @param mixed $value
     * @return string
     */
    public static function toAccountId($value) {
        return (string)$value;
    }
}

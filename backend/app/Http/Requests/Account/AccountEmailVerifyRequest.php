<?php

declare(strict_types=1);

namespace App\Http\Requests\Account;

use App\Http\Requests\RequestCommon;

class AccountEmailVerifyRequest extends RequestCommon {
    /**
     * アカウントメールアドレス認証トークンの入力バリデーション
     *
     * @return array<string, mixed>
     */
    public function rules() {
        return [
            'token' => ['required', 'string']
        ];
    }
}

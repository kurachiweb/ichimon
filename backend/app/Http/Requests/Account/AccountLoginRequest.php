<?php

declare(strict_types=1);

namespace App\Http\Requests\Account;

use App\Http\Requests\RequestCommon;

class AccountLoginRequest extends RequestCommon {
    /**
     * アカウントログインの入力バリデーション
     *
     * @return array<string, mixed>
     */
    public function rules() {
        return [
            'name' => ['required', 'string'],
            'password' => ['required', 'string']
        ];
    }
}

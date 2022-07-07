<?php

declare(strict_types=1);

namespace App\Http\Requests\Account;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AccountEmailVerifyRequest extends FormRequest {
    /**
     * 認可チェック。必要ならミドルウェアに任せる。
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

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

    /**
     * バリデーションエラー時
     *
     * @param \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(Validator $validator) {
        $res = response()->badRequest(null, $validator->errors());
        throw new HttpResponseException($res);
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class AccountLoginRequest extends FormRequest {
    /**
     * 認可チェック。必要ならミドルウェアに任せる。
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

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

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

use App\Rules\DbPrimaryStringValidation;

class AccountRequest extends FormRequest {
    /**
     * 認可チェック。ミドルウェアに任せる。
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * アカウント基本情報の入力バリデーション
     *
     * @return array<string, mixed>
     */
    public function rules() {
        return [
            'account' => ['bail', 'required'],
            'account.id' => ['required', new DbPrimaryStringValidation()],
            'account.display_id' => ['required', 'string']
        ];
    }

    /**
     * バリデーションエラー時
     *
     * @param  \Illuminate\Contracts\Validation\Validator $validator
     * @return void
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException
     */
    protected function failedValidation(Validator $validator) {
        $res = response()->json([
            'message' => $validator->errors(),
        ], 400);
        throw new HttpResponseException($res);
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

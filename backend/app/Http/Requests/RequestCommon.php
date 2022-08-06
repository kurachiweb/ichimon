<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class RequestCommon extends FormRequest {
    /**
     * 認可チェックはミドルウェアに任せる。
     *
     * @return bool
     */
    public function authorize() {
        return true;
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

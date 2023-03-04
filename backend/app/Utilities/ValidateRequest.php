<?php

declare(strict_types=1);

namespace App\Utilities;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

/**
 * リクエストの汎用バリデーション
 */
class ValidateRequest {
    /**
     * JSON形式リクエストのバリデーション
     *
     * @throws ValidationException
     */
    public static function json(Request $request, FormRequest $form_request): array {
        $body = $request->getContent();
        if (!is_string($body)) {
            // リクエストボディが文字列型以外では、json_decodeできない
            throw new ValidationException('Request not JSON.', Response::HTTP_BAD_REQUEST);
        }

        $req = json_decode($body, true);
        if (!is_array($req)) {
            // リクエスト内容が[]や{}でなければ、総じてバリデーションエラー
            throw new ValidationException('Request not JSON.', Response::HTTP_BAD_REQUEST);
        }

        // リクエストを入力チェック
        $validator = Validator::make($req, $form_request->rules());
        return $validator->validated();
    }
}

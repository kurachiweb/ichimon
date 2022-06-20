<?php

declare(strict_types=1);

namespace App\Utilities;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use JsonException;

/**
 * リクエストの汎用バリデーション
 */
class ValidateRequest {
  /**
   * JSON形式リクエストのバリデーション
   *
   * @param \Illuminate\Http\Request $request
   * @param \Illuminate\Http\Request $form_request
   * @return array
   * @throws \Illuminate\Validation\ValidationException
   */
  public static function json(Request $request, FormRequest $form_request) {
    $body = $request->getContent();
    if (gettype($body) !== "string") {
      // リクエストボディが文字列型以外では、json_decodeできない
      throw new ValidationException('Request not JSON.', 400);
    }

    try {
      $req = json_decode($body, true, 512, JSON_THROW_ON_ERROR);
    } catch (JsonException $e) {
      throw new ValidationException('Request not JSON.', $e->getCode());
    }

    // リクエストを入力チェック
    $validator = Validator::make($req, $form_request->rules());
    return $validator->validated();
  }
}

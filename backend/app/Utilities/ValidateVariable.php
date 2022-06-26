<?php

declare(strict_types=1);

namespace App\Utilities;

use Illuminate\Support\Facades\Validator;

/**
 * 変数の汎用バリデーション
 */
class ValidateVariable {
  /**
   * 複数の変数をオブジェクトで包み、バリデーターを生成する
   *
   * @param array<int, array> $inputs
   * @return \Illuminate\Contracts\Validation\Validator
   */
  public static function make($inputs) {
    // 各アイテムの先頭が検証する変数、それにバリデーションルールが続く
    // $inputs = [
    //   [$req_account_id, 'required', new DbPrimaryStringValidation()],
    //   [$cookie_account_id, 'required', new DbPrimaryStringValidation()],
    // ];
    // 次のように変換される
    // $validate_target = [
    //   '0' => $req_account_id,
    //   '1' => $cookie_account_id
    // ];
    // $validate_by = [
    //   '0' => ['required', new DbPrimaryStringValidation()],
    //   '1' => ['required', new DbPrimaryStringValidation()]
    // ];
    $validate_target = [];
    $validate_by = [];

    foreach ($inputs as $index => $input) {
      // 長さ2以上の配列、つまり検証値と1つ以上のルール定義が必須
      if (!is_array($input) || count($input) <= 1) {
        continue;
      }
      $validate_target["$index"] = $input[0];
      $validate_by["$index"] = array_slice($input, 1);
    }

    return Validator::make($validate_target, $validate_by);
  }
}

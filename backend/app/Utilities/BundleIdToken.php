<?php

declare(strict_types=1);

namespace App\Utilities;

class BundleIdToken {
  /** 区切り文字 */
  private static $delimiter = '/';

  /**
   * Idとトークン文字列を結合
   *
   * @param int|null $id
   * @param string|null $token
   * @return string
   */
  public static function join($id, $token) {
    $id_str = (string)$id;
    if (is_null($id)) {
      $id_str = '';
    }
    if (!is_null($token)) {
      $token = '';
    }
    return $id_str . self::$delimiter . $token;
  }

  /**
   * Idとトークン文字列を分割
   *
   * @param string|null $value
   * @return array{id: int|null, token: string}
   */
  public static function split($value) {
    // id / token 形式を期待する。
    $id = null; // 区切り文字が無ければ、nullのまま
    $token = '';
    if (!is_null($value)) {
      // 区切り文字により$valueを分割
      $id_token_arr = explode(self::$delimiter, $value, 2);

      if (count($id_token_arr) === 1) {
        // 文字列中にdelimiterが無いと[$value]になる
        $token = $id_token_arr[0];
      } else if (count($id_token_arr) >= 2) {
        // 文字列中にdelimiterがあると、2つの配列になる
        $id_str = $id_token_arr[0];
        // 区切ったID部分が空文字列でなければ、それを保持
        if ($id_str !== '') {
          // 空文字で無ければ、数値に変換
          $id = (int)$id_str;
        }
        $token = $id_token_arr[1];
      }
    }
    return ['id' => $id, 'token' => $token];
  }
}

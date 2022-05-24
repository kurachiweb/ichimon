<?php

namespace App\Utilities;

class BundleIdToken {
  /** 区切り文字 */
  private static $delimiter = '/';

  /**
   * Idとトークン文字列を結合
   *
   * @param int $id
   * @param string $token
   * @return int
   */
  public static function join(int $id, $token) {
    return $id . self::$delimiter . $token;
  }

  /**
   * Idとトークン文字列を分割
   *
   * @param string $value
   * @return int
   */
  public static function split(string $value) {
    // 区切り文字により$valueを分割
    $id_token_arr = explode(self::$delimiter, $value, 2);
    $id = null; // 区切り文字が無ければ、nullのまま
    $token = '';
    if (count($id_token_arr) === 1) {
      // 文字列中にdelimiterが無いと[$value]になる
      $token = $id_token_arr[0];
    } else if (count($id_token_arr) >= 2) {
      // 文字列中にdelimiterがあると、2つ以上の配列になる
      $id = (int)$id_token_arr[0];
      $token = $id_token_arr[1];
    }
    return ['id' => $id, 'token' => $token];
  }
}

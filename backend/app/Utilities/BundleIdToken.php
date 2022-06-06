<?php

declare(strict_types=1);

namespace App\Utilities;

class BundleIdToken {
  /**
   * Idとトークン文字列を結合
   *
   * @param int|null $id
   * @param string|null $token
   * @return string
   */
  public static function bundle($id, $token) {
    $bundler = [];
    if (!is_null($id)) {
      $bundler['id'] = $id;
    } else {
      $bundler['id'] = null;
    }
    if (!is_null($token)) {
      $bundler['token'] = $token;
    } else {
      $bundler['token'] = null;
    }
    return json_encode($bundler);
  }

  /**
   * Idとトークン文字列を分解
   *
   * @param string|null $value
   * @return array{id: int|null, token: string|null}
   */
  public static function expand($joined) {
    $id = null;
    $token = null;
    if (!is_null($joined)) {
      // 配列としてデコード
      $expander = json_decode($joined, true);
      $id = $expander['id'];
      $token = $expander['token'];
    }
    return ['id' => $id, 'token' => $token];
  }
}

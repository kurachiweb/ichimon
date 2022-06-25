<?php

declare(strict_types=1);

namespace App\Utilities;

class KeysOnly {
  /**
   * 配列の、指定キーだけを抽出
   *
   * @param array $input
   * @param array<int, string> $keys
   * @return array
   */
  public static function select($input, $keys) {
    // array_flipにより['foo', 'bar']を['foo' => 0, 'bar' => 1]にする
    // array_intersect_keyにより、$inputとarray_flip($keys)の両方にあるキーのみによる配列を作る
    return array_intersect_key($input, array_flip($keys));
  }
}

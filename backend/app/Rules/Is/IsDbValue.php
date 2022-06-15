<?php

declare(strict_types=1);

namespace App\Rules\Is;

use App\Constants\ConstBackend;

class IsDbValue {
  /**
   * テーブルの、主キー制約付きbigint型カラムに入れる値として適切か
   *
   * @param mixed $value
   * @return true|string
   */
  public static function isPrimaryBigint($value) {
    if (!isset($value)) {
      // 未定義やnullは不可
      return "Empty value.";
    }
    if (!is_int($value)) {
      // 整数以外は不可
      return "Not number.";
    }
    if ($value < ConstBackend::DB_TABLE_ID_MIN) {
      // 最小値より小さい数値は不可
      return "Too low.";
    }
    if (ConstBackend::DB_TABLE_ID_MAX < $value) {
      // 最大値より大きい数値は不可
      return "Too high.";
    }
    return true;
  }
}

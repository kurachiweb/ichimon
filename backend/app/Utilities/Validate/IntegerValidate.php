<?php

declare(strict_types=1);

namespace App\Utilities\Validate;

class IntegerValidate {
  /**
   * 整数もしくは整数形式の文字列か
   *
   * @param mixed $value
   * @return true|string
   */
  public static function isIntegerString($value) {
    if (!isset($value)) {
      // 未定義やnullは不可
      return "Empty value.";
    }
    switch (gettype($value)) {
      case 'integer':
        // 整数型の場合、可
        break;
      case 'double':
        // 浮動小数点数型の場合、数以外は不可
        return "Not integer.";
      case 'string':
        // 文字列型の場合、数字以外は不可
        if (!preg_match('/^[0-9]+$/', $value)) {
          return "Not number string.";
        }
        break;
      default:
        // 他の型の場合、数字以外は不可
        return "Not number.";
    }
    return true;
  }
}

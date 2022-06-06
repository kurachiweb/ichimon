<?php

declare(strict_types=1);

namespace App\Utilities;

use Illuminate\Support\Facades\Crypt;

class StringEncrypt {
  /**
   * 暗号化
   *
   * @param string $value
   * @return string|null
   */
  public static function encrypt($value) {
    if (is_null($value)) {
      return null;
    }
    // AES-256-CBCによる可逆暗号化
    return Crypt::encryptString($value);
  }

  /**
   * 復号
   *
   * @param string $value
   * @return string|null
   */
  public static function decrypt($value) {
    if (is_null($value)) {
      return null;
    }
    return Crypt::decryptString($value);
  }
}

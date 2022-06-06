<?php

declare(strict_types=1);

namespace App\Utilities;

class PasswordHash {
  /**
   * パスワードのハッシュ化
   *
   * @param string $value
   * @return string|null
   */
  public static function convert($value) {
    if (is_null($value)) {
      return null;
    }
    return password_hash($value, PASSWORD_ARGON2ID);
  }
}

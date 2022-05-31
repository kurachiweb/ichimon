<?php
declare(strict_types=1);

namespace App\Utilities;

class StringHash {
  /**
   * ハッシュ化
   *
   * @param string $value
   * @return string|null
   */
  public static function convert($value) {
    if ($value === null) {
      return null;
    }
    return hash('sha3-512', $value);
  }
}

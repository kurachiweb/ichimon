<?php

namespace App\Utilities;

use App\Constants\ConstBackend;

class RandomNumber {
  /**
   * 乱数生成、min以上max以下
   *
   * @param  int $min
   * @param  int $max
   * @return int
   */
  public function generate($min, $max) {
    return random_int($min, $max);
  }

  /**
   * 乱数生成、DBテーブル主キー用
   *
   * @return int
   */
  public function dbTableId() {
    return $this->generate(1, ConstBackend::MAX_TABLE_ID);
  }
}

<?php

declare(strict_types=1);

namespace App\Utilities;

use App\Constants\ConstBackend;

class Random {
  /**
   * ランダム文字列生成
   *
   * @param int $length
   * @return string
   */
  public static function generateString(int $length) {
    // 返すランダム文字列、処理の過程で連結していく
    $random_str = '';
    // 連結したランダム文字列の文字数、指定文字数以上まで増える
    $part_len = 0;

    // PHP_INT_MAXを超えない大きな36の乗数を最大値とする乱数から、36進数に変換する
    // 指定文字数に達するまで何度も生成し、文字結合をする
    while ($part_len < $length) {
      $need_part_len = 5; // 36**5-1
      if (PHP_INT_SIZE >= 8) {
        $need_part_len = 12; // 36**12-1
      }

      // 最大値、32ビット環境を考えてデフォルトは36^5-1、64ビット環境なら36^12-1
      $max = 36 ** $need_part_len - 1;
      $random_dec = random_int(0, $max);

      // 5文字か12文字の36進数ランダム文字列に変換
      $random_dec_str = base_convert((string)$random_dec, 10, 36);
      $random_str .= str_pad($random_dec_str, $need_part_len, "0", STR_PAD_LEFT);
      $part_len = strlen($random_str);
    }

    // ループ後、ランダム文字列は$len以上の文字数になるため、余分を取り除く
    return substr($random_str, 0, $length);
  }

  /**
   * 乱数生成、DBテーブル主キー用
   *
   * @return string
   */
  public static function dbPrimaryId() {
    // 僅かでも数字だけになることのないよう、0~9にしないための辞書
    $az = 'abcdefghijklmnopqrstuvwxyz';
    /** タイムスタンプ部の文字数 */
    $timestam_part_length = 9;

    // タイムスタンプ部、1ミリ秒の精度で、指定桁数になるよう0埋めする
    $now_microtime = microtime(true);
    $now_millsec = (int)($now_microtime * 1000);
    $timestamp_conv = base_convert((string)$now_millsec, 10, 36);
    $time_part = str_pad($timestamp_conv, $timestam_part_length, '0', STR_PAD_LEFT);

    // 中間部、僅かでも数字だけになることのないように、a-zを保証する1文字を挟む
    $interfix_part = substr($az, random_int(0, strlen($az) - 1), 1);

    // ランダム部
    $random_part = self::generateString(ConstBackend::DB_TABLE_ID_LENGTH  - $timestam_part_length - 1);

    return $time_part . $interfix_part . $random_part;
  }
}

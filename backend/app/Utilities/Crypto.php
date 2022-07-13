<?php

declare(strict_types=1);

namespace App\Utilities;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Contracts\Encryption\EncryptException;

class Crypto {
  /**
   * 暗号キー
   *
   * @return string
   */
  private static function getKey() {
    return (string)config('app.save_key');
  }

  /**
   * 暗号化方式
   *
   * @var string
   */
  private static function getCipher() {
    return strtolower(config('app.cipher'));
  }

  /**
   * 任意文字列を暗号化
   *
   * @param string|null $value
   * @return string|null
   */
  public static function toEncryptString($value) {
    if (is_null($value)) {
      return null;
    } else if ($value === '') {
      return '';
    }
    return self::encryptString($value);
  }

  /**
   * 文字列の暗号化
   *
   * @param string $value
   * @return string
   */
  private static function encryptString($value) {
    // 暗号化方式
    $cipher = self::getCipher();
    // 初期化ベクトル
    // AES-256-GCMの場合、長さ32のランダムバイト
    $iv = random_bytes(openssl_cipher_iv_length($cipher));
    // 認証タグ
    // GCMモードのような認証付き暗号(AEAD)で使う
    $tag = null;
    // メッセージ認証符号
    // 認証付き暗号では使わない
    $mac = '';

    // 文字列を暗号化
    $encrypted = openssl_encrypt(
      $value,
      $cipher,
      self::getKey(),
      0,
      $iv,
      $tag
    );
    if ($encrypted === false) {
      // 暗号化に失敗した
      throw new EncryptException('Could not encrypt the data.');
    }

    $bundle_raw = [
      'iv' => base64_encode($iv),
      'value' => $encrypted,
      'mac' => $mac,
      'tag' => base64_encode($tag ?? '')
    ];

    $bundled = json_encode($bundle_raw, JSON_UNESCAPED_SLASHES);
    if (json_last_error() !== JSON_ERROR_NONE) {
      // 暗号化データの文字列エンコードに失敗した
      throw new EncryptException('Could not encrypt the data.');
    }

    return base64_encode($bundled);
  }

  /**
   * 任意文字列を復号
   *
   * @param string|null $value
   * @return string|null
   */
  public static function toDecryptString($value) {
    if (is_null($value)) {
      return null;
    } else if ($value === '') {
      return '';
    }
    return self::decryptString($value);
  }

  /**
   * 文字列の復号
   *
   * @param string $value
   * @return string
   */
  private static function decryptString($value) {
    // 暗号化方式
    $cipher = self::getCipher();

    // 暗号化したデータのデコード
    $payload = json_decode(base64_decode($value), true);
    if (!is_array($payload) || !isset($payload['iv'], $payload['value'], $payload['mac'], $payload['tag'])) {
      // 復号に必要なデータが無い
      throw new DecryptException('Could not decrypt the data.');
    }

    // 初期化ベクトルのデコード、失敗した場合はfalse
    $iv = base64_decode($payload['iv'], true);
    if ($iv === false || strlen($iv) !== openssl_cipher_iv_length($cipher)) {
      // 初期化ベクトルの値が不正であるか、または長さ検証を通らなかった
      throw new DecryptException('Could not decrypt the data.');
    }

    $tag = base64_decode($payload['tag']);
    if (strlen($tag) !== 16) {
      // タグが不正である、認証付き暗号の場合、長さが16であるべき
      throw new DecryptException('Could not decrypt the data.');
    }

    // 復号して元の文字列を取得
    $decrypted = \openssl_decrypt(
      $payload['value'],
      $cipher,
      self::getKey(),
      0,
      $iv,
      $tag ?? ''
    );
    if ($decrypted === false) {
      throw new DecryptException('Could not decrypt the data.');
    }

    return $decrypted;
  }
}

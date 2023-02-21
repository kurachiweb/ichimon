<?php

declare(strict_types=1);

namespace App\Constants;

/**
 * 定数：バックエンド
 */
class ConstBackend {
  /** DBテーブル保存用ID：文字列の長さ */
  const DB_TABLE_ID_LENGTH = 31;
  /** キャッシュに追加したアカウント情報の有効期限[秒] */
  const CACHE_ACCOUNT_EXPIRATION = 600;

  /** アカウント認証ステータス：未認証 */
  const ACCOUNT_VERIFY_NOT = 0;
  /** アカウント認証ステータス：認証手続き中 */
  const ACCOUNT_VERIFY_SEND = 1;
  /** アカウント認証ステータス：認証済み */
  const ACCOUNT_VERIFY_VERIFY = 2;
  /** アカウントメールアドレスの認証有効期限[秒] */
  const ACCOUNT_VERIFY_EXPIRATION = 1800;

  /** アカウントログイントークンCookie名 */
  const COOKIE_ACCOUNT_LOGIN_NAME = 'ichimon_alt';
}

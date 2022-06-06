<?php

declare(strict_types=1);

namespace App\Constants;

/**
 * 定数：バックエンド
 */
class ConstBackend {
  /** DBテーブル保存用ID：最小値 */
  const DB_TABLE_ID_MIN = 10000000000;
  /** DBテーブル保存用ID：最大値 */
  const DB_TABLE_ID_MAX = 99999999999999;

  /** アカウント認証ステータス：未認証 */
  const ACCOUNT_VERIFY_NOT = 0;
  /** アカウント認証ステータス：認証手続き中 */
  const ACCOUNT_VERIFY_SEND = 1;
  /** アカウント認証ステータス：認証済み */
  const ACCOUNT_VERIFY_VERIFY = 2;
  /** アカウントのメールアドレス認証有効期限[秒] */
  const ACCOUNT_VERIFY_EXPIRE_SECOND = 1800;

  /** クッキー名；ログイントークン */
  const COOKIE_NAME_LOGIN_TOKEN = 'ichimon_alt';
}

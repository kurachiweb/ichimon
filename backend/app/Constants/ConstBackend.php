<?php

declare(strict_types=1);

namespace App\Constants;

/**
 * 定数：バックエンド
 */
class ConstBackend {
  /** 指数表記にならない最大の値 */
  const MAX_TABLE_ID = 99999999999999;

  /** アカウント認証ステータス：未認証 */
  const ACCOUNT_VERIFY_NOT = 0;
  /** アカウント認証ステータス：認証手続き中 */
  const ACCOUNT_VERIFY_SEND = 1;
  /** アカウント認証ステータス：認証済み */
  const ACCOUNT_VERIFY_VERIFY = 2;
  /** アカウントのメールアドレス認証有効期限[秒] */
  const ACCOUNT_VERIFY_EXPIRE_SECOND = 1800;

  /** クッキー名；ログイントークン */
  const COOKIE_NAME_LOGIN_TOKEN = 'alt';
}

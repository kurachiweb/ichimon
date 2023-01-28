<?php

declare(strict_types=1);

namespace App\Constants\Db\Account;

use App\Constants\Db\DbTableCommon;

/**
 * 定数：アカウント認証情報のカラム名
 */
class DbTableAccountAuth extends DbTableCommon {
  /** アカウント認証情報：テーブル名 */
  const TABLE_NAME = 'account_auth';

  /** アカウント認証情報：対象のアカウントID */
  const ACCOUNT_ID = 'account_id';
  /** アカウント認証情報：メールアドレスの暗号化済み文字列 */
  const EMAIL = 'email';
  /** アカウント認証情報：メールアドレスの暗号化済み文字列 */
  const EMAIL_HASH = 'email_hash';
  /** アカウント認証情報：メールアドレスの暗号化済み文字列（主とするメールアドレスが使えなくなった場合の連絡用） */
  const EMAIL_ALTER = 'email_alter';
  /** アカウント認証情報：携帯電話番号の暗号化済み文字列 */
  const MOBILE_NO = 'mobile_no';
  /** アカウント認証情報：メールアドレスの存在が確認されたか */
  const VERIFIED_EMAIL = 'verified_email';
  /** アカウント認証情報：メールアドレスの存在が確認されたか */
  const VERIFIED_MOBILE_NO = 'verified_mobile_no';
  /** アカウント認証情報：ログインパスワード */
  const PASSWORD = 'password';
  /** アカウント認証情報：パスワードの最終更新日時 */
  const PASSWORD_UPDATED_AT = 'password_updated_at';
  /** アカウント認証情報：サブスクリプションの管理用トークン */
  const BILLING_TOKEN = 'billing_token';
}

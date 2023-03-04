<?php

declare(strict_types=1);

namespace App\Constants\Db\Account;

use App\Constants\Db\DbName;
use App\Constants\Db\DbTableCommon;
use App\Constants\Db\DbTableName;

/**
 * 定数: アカウント認証情報
 */
class DbTableAccountAuth extends DbTableCommon {
  /** アカウント認証情報: DB名 */
  const DB_NAME = DbName::ACCOUNT;
  /** アカウント認証情報: テーブル名 */
  const TABLE_NAME = DbTableName::ACCOUNT_AUTH;

  /** アカウント認証情報: 対象のアカウント基本ID */
  const ACCOUNT_ID = 'account_id';
  /** アカウント認証情報: メールアドレスの暗号化済み文字列 */
  const EMAIL = 'email';
  /** アカウント認証情報: メールアドレスのハッシュ文字列(メールアドレスが他のアカウントで使われているかの判定用) */
  const EMAIL_HASH = 'email_hash';
  /** アカウント認証情報: メールアドレスの認証状態 */
  const VERIFIED_EMAIL = 'verified_email';
  /** アカウント認証情報: ログインパスワード */
  const PASSWORD = 'password';
  /** アカウント認証情報: パスワードの最終更新日時 */
  const PASSWORD_UPDATED_AT = 'password_updated_at';
}

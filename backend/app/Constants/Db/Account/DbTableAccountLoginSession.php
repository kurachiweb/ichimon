<?php

declare(strict_types=1);

namespace App\Constants\Db\Account;

use App\Constants\Db\DbName;
use App\Constants\Db\DbTableSessionCommon;
use App\Constants\Db\DbTableName;

/**
 * 定数: アカウントログイン保持情報
 */
class DbTableAccountLoginSession extends DbTableSessionCommon {
  /** アカウントログイン保持情報: DB名 */
  const DB_NAME = DbName::ACCOUNT;
  /** アカウントログイン保持情報: テーブル名 */
  const TABLE_NAME = DbTableName::ACCOUNT_LOGIN_SESSION;

  /** アカウントログイン保持情報: 対象のアカウント基本ID */
  const ACCOUNT_ID = 'account_id';
  /** アカウントログイン保持情報: トークンのハッシュ文字列 */
  const TOKEN_HASH = 'token_hash';
  /** アカウントログイン保持情報: IPアドレスの暗号化文字列 */
  const IP_ADDRESS = 'ip_address';
  /** アカウントログイン保持情報: ユーザーエージェントの暗号化文字列 */
  const USER_AGENT = 'user_agent';
  /** アカウントログイン保持情報: 最終ログイン日時 */
  const LAST_LOGIN_AT = 'last_login_at';
}

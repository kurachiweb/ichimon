<?php

declare(strict_types=1);

namespace App\Constants\Db\Account;

use App\Constants\Db\DbTableCommon;

/**
 * 定数：アカウントログイン保持情報のカラム名
 */
class DbTableAccountLoginSession extends DbTableCommon {
  /** アカウントログイン保持情報：テーブル名 */
  const TABLE_NAME = 'account_login_session';

  /** アカウントログイン保持情報：対象のアカウントID */
  const ACCOUNT_ID = 'account_id';
  /** アカウントログイン保持情報：トークンのハッシュ文字列 */
  const TOKEN_HASH = 'token_hash';
  /** アカウントログイン保持情報：発信元IPアドレス */
  const IP_ADDRESS = 'ip_address';
  /** アカウントログイン保持情報：ユーザーエージェントの暗号化文字列 */
  const USER_AGENT = 'user_agent';
}

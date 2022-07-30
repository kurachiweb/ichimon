<?php

declare(strict_types=1);

namespace App\Constants\Db\Account;

use App\Constants\Db\DbTableCommon;

/**
 * 定数：アカウントメールアドレス照合情報のカラム名
 */
class DbTableAccountVerifyEmail extends DbTableCommon {
  /** アカウントメールアドレス照合情報：テーブル名 */
  const TABLE_NAME = 'verify_email_token';

  /** アカウントメールアドレス照合情報：メールアドレス認証リクエストの際に発行されたトークン */
  const TOKEN = 'token';
  /** アカウントメールアドレス照合情報：対象のアカウントID */
  const ACCOUNT_ID = 'account_id';
}

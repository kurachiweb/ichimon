<?php

declare(strict_types=1);

namespace App\Constants\Db\Account;

use App\Constants\Db\DbTableCommon;

/**
 * 定数：アカウント基本情報のカラム名
 */
class DbTableAccount extends DbTableCommon {
  /** アカウント基本情報：テーブル名 */
  const TABLE_NAME = 'account';

  /** アカウント基本情報：表示用アカウントID */
  const DISPLAY_ID = 'display_id';
  /** アカウント基本情報：表示用ニックネーム */
  const NICKNAME = 'nickname';
  /** アカウント基本情報：アカウント登録完了日時 */
  const REGISTERED_AT = 'registered_at';
}

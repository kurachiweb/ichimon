<?php

declare(strict_types=1);

namespace App\Constants\Db\Account;

use App\Constants\Db\DbName;
use App\Constants\Db\DbTableCommon;
use App\Constants\Db\DbTableName;

/**
 * 定数: アカウント基本情報
 */
class DbTableAccount extends DbTableCommon {
  /** アカウント基本情報: DB名 */
  const DB_NAME = DbName::ACCOUNT;
  /** アカウント基本情報: テーブル名 */
  const TABLE_NAME = DbTableName::ACCOUNT;

  /** アカウント基本情報: 表示用ニックネーム */
  const NICKNAME = 'nickname';
  /** アカウント基本情報: 自己紹介 */
  const self_intro = 'self_intro';
  /** アカウント基本情報: アカウント登録完了日時 */
  const REGISTERED_AT = 'registered_at';
}

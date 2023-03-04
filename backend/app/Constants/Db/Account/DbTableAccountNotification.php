<?php

declare(strict_types=1);

namespace App\Constants\Db\Account;

use App\Constants\Db\DbName;
use App\Constants\Db\DbTableCommon;
use App\Constants\Db\DbTableName;

/**
 * 定数: アカウントの通知設定
 */
class DbTableAccountNotification extends DbTableCommon {
  /** アカウントの通知設定: テーブル名 */
  const TABLE_NAME = 'account_notification';

  /** アカウントの通知設定: 対象のアカウント基本ID */
  const ACCOUNT_ID = 'account_id';
  /** アカウントの通知設定: 通知手段 */
  const WAY = 'way';
  /** アカウントの通知設定: 通知トリガーの発生タイミング */
  const TRIGGER = 'trigger';
  /** アカウントの通知設定: その通知トリガーは有効か */
  const ENABLED = 'enabled';
}

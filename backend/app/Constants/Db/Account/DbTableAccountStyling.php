<?php

declare(strict_types=1);

namespace App\Constants\Db\Account;

use App\Constants\Db\DbName;
use App\Constants\Db\DbTableCommon;
use App\Constants\Db\DbTableName;

/**
 * 定数: アカウント別の表示設定
 */
class DbTableAccountStyling extends DbTableCommon {
  /** アカウント別の表示設定: DB名 */
  const DB_NAME = DbName::ACCOUNT;
  /** アカウント別の表示設定: テーブル名 */
  const TABLE_NAME = DbTableName::ACCOUNT_STYLING;

  /** アカウント別の表示設定: 対象のアカウント基本ID */
  const ACCOUNT_ID = 'account_id';
  /** アカウント別の表示設定: フォントの大きさ(px値の等倍) */
  const FONT_SIZE = 'font_size';
  /** アカウント別の表示設定: ヘッダーの大きさ */
  const HEADER_SIZE = 'header_size';
  /** アカウント別の表示設定: 表示言語 */
  const LANGUAGE = 'language';
  /** アカウント別の表示設定: 時刻表示におけるタイムゾーン */
  const TIMEZONE = 'timezone';
}

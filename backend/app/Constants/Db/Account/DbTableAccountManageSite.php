<?php

declare(strict_types=1);

namespace App\Constants\Db\Account;

use App\Constants\Db\DbName;
use App\Constants\Db\DbTableCommon;
use App\Constants\Db\DbTableName;

/**
 * 定数: アカウント別のアンケート公開先サイト情報
 */
class DbTableAccountManageSite extends DbTableCommon {
    /** アンケート公開先サイト情報: DB名 */
    const DB_NAME = DbName::ACCOUNT;
    /** アンケート公開先サイト情報: テーブル名 */
    const TABLE_NAME = DbTableName::ACCOUNT_MANAGE_SITE;

    /** アンケート公開先サイト情報: 対象のアカウント基本ID */
    const ACCOUNT_ID = 'account_id';
    /** アンケート公開先サイト情報: 公開先サイトのタイトル */
    const TITLE = 'title';
    /** アンケート公開先サイト情報: 公開先サイトのURL */
    const URL = 'url';
    /** アンケート公開先サイト情報: ソート順位 */
    const SORT_PRIORITY = 'sort_priority';
}

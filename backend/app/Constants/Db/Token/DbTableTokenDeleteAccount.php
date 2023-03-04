<?php

declare(strict_types=1);

namespace App\Constants\Db\Account;

use App\Constants\Db\DbName;
use App\Constants\Db\DbTableTokenCommon;
use App\Constants\Db\DbTableName;

/**
 * 定数: アカウントパスワードの削除リクエスト照合情報
 */
class DbTableTokenDeleteAccount extends DbTableTokenCommon {
    /** アカウントの削除照合情報: DB名 */
    const DB_NAME = DbName::TOKEN;
    /** アカウントの削除照合情報: テーブル名 */
    const TABLE_NAME = DbTableName::TOKEN_DELETE_ACCOUNT;

    /** アカウントの削除照合情報: 対象のアカウント基本ID */
    const ACCOUNT_ID = 'account_id';
}

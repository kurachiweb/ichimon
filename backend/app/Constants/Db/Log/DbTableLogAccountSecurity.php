<?php

declare(strict_types=1);

namespace App\Constants\Db\Log;

use App\Constants\Db\DbName;
use App\Constants\Db\DbTableLogCommon;
use App\Constants\Db\DbTableName;

/**
 * 定数: アカウントのセキュリティログ
 */
class DbTableLogAccountSecurity extends DbTableLogCommon {
    /** アカウントのセキュリティログ: DB名 */
    const DB_NAME = DbName::LOG;
    /** アカウントのセキュリティログ: テーブル名 */
    const TABLE_NAME = DbTableName::LOG_ACCOUNT_SECURITY;

    /** アカウントのセキュリティログ: 対象のアカウント基本ID */
    const ACCOUNT_ID = 'account_id';
}

<?php

declare(strict_types=1);

namespace App\Constants\Db\Token;

use App\Constants\Db\DbName;
use App\Constants\Db\DbTableTokenCommon;
use App\Constants\Db\DbTableName;

/**
 * 定数: アカウントメールアドレスの変更リクエスト照合情報
 */
class DbTableTokenChangeEmail extends DbTableTokenCommon {
    /** アカウントメールアドレスの変更照合情報: DB名 */
    const DB_NAME = DbName::TOKEN;
    /** アカウントメールアドレスの変更照合情報: テーブル名 */
    const TABLE_NAME = DbTableName::TOKEN_CHANGE_EMAIL;

    /** アカウントメールアドレスの変更照合情報: 対象のアカウント基本ID */
    const ACCOUNT_ID = 'account_id';
}

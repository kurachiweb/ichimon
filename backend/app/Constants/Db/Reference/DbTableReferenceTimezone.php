<?php

declare(strict_types=1);

namespace App\Constants\Db\Reference;

use App\Constants\Db\DbName;
use App\Constants\Db\DbTableName;
use App\Constants\Db\DbTableReferenceCommon;

/**
 * 定数: タイムゾーン
 */
class DbTableReferenceTimezone extends DbTableReferenceCommon {
    /** タイムゾーン: DB名 */
    const DB_NAME = DbName::REFERENCE;
    /** タイムゾーン: テーブル名 */
    const TABLE_NAME = DbTableName::REFERENCE_TIMEZONE;

    /** タイムゾーン: IANA Time Zone Databaseに基づく表記 */
    const NAME = 'name';
    /** タイムゾーン: そのタイムゾーンに該当する国や地域 */
    const AREA = 'area';
    /** タイムゾーン: 協定世界時との差(分単位) */
    const UTC_OFFSET = 'utc_offset';
}

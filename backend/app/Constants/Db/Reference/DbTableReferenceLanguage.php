<?php

declare(strict_types=1);

namespace App\Constants\Db\Reference;

use App\Constants\Db\DbName;
use App\Constants\Db\DbTableName;
use App\Constants\Db\DbTableReferenceCommon;

/**
 * 定数: 表示言語
 */
class DbTableReferenceLanguage extends DbTableReferenceCommon {
    /** 表示言語: DB名 */
    const DB_NAME = DbName::REFERENCE;
    /** 表示言語: テーブル名 */
    const TABLE_NAME = DbTableName::REFERENCE_LANGUAGE;

    /** タイムゾーン: RFC 5646に基づく言語タグ */
    const NAME = 'name';
    /** タイムゾーン: 各言語に合わせた言語名表記 */
    const LOCALIZED_NAME = 'localized_name';
}

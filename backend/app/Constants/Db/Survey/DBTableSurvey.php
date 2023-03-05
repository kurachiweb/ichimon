<?php

declare(strict_types=1);

namespace App\Constants\Db\Survey;

use App\Constants\Db\DbName;
use App\Constants\Db\DbTableCommon;
use App\Constants\Db\DbTableName;

/**
 * 定数: アンケート情報
 */
class DBTableSurvey extends DbTableCommon {
    /** アンケート情報: DB名 */
    const DB_NAME = DbName::SURVEY;
    /** アンケート情報: テーブル名 */
    const TABLE_NAME = DbTableName::SURVEY;

    /** アンケート情報: 対象のアカウント基本ID */
    const ACCOUNT_ID = 'account_id';
    /** アンケート情報: 作成者向けのタイトル */
    const TITLE = 'title';
    /** アンケート情報: 回答者向けのつかみメッセージ */
    const GREETING = 'greeting';
    /** アンケート情報: 回答者向けの説明 */
    const DESCRIPTION = 'description';
    /** アンケート情報: アンケート公開開始日時 */
    const PUBLISH_START_AT = 'publish_start_at';
    /** アンケート情報: アンケート公開終了日時 */
    const PUBLISH_END_AT = 'publish_end_at';
}

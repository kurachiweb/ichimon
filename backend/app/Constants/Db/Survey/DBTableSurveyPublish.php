<?php

declare(strict_types=1);

namespace App\Constants\Db\Survey;

use App\Constants\Db\DbName;
use App\Constants\Db\DbTableCommon;
use App\Constants\Db\DbTableName;

/**
 * 定数: アンケートを公開する対象URL
 */
class DBTableSurveyPublish extends DbTableCommon {
    /** アンケートを公開する対象URL: DB名 */
    const DB_NAME = DbName::SURVEY;
    /** アンケートを公開する対象URL: テーブル名 */
    const TABLE_NAME = DbTableName::SURVEY_PUBLISH;

    /** アンケートを公開する対象URL: 対象のアンケートID */
    const SURVEY_ID = 'survey_id';
    /** アンケートを公開する対象URL: アカウント設定に紐づく、アンケート公開対象URL */
    const ACCOUNT_URL_ID = 'account_url_id';
}

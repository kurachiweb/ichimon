<?php

declare(strict_types=1);

namespace App\Constants\Db\Survey;

use App\Constants\Db\DbName;
use App\Constants\Db\DbTableCommon;
use App\Constants\Db\DbTableName;

/**
 * 定数: アンケートの質問項目
 */
class DBTableSurveyQuestion extends DbTableCommon {
    /** アンケートの質問項目: DB名 */
    const DB_NAME = DbName::SURVEY;
    /** アンケートの質問項目: テーブル名 */
    const TABLE_NAME = DbTableName::SURVEY_QUESTION;

    /** アンケートの質問項目: 対象のアンケートID */
    const SURVEY_ID = 'survey_id';
    /** アンケートの質問項目: 質問の種類 */
    const TYPE = 'type';
    /** アンケートの質問項目: 質問分 */
    const DESCRIPTION = 'description';
}

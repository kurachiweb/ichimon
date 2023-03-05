<?php

declare(strict_types=1);

namespace App\Constants\Db\Survey;

use App\Constants\Db\DbName;
use App\Constants\Db\DbTableCommon;
use App\Constants\Db\DbTableName;

/**
 * 定数: 回答選択肢
 */
class DBTableQuestionChoice extends DbTableCommon {
    /** 回答選択肢: DB名 */
    const DB_NAME = DbName::SURVEY;
    /** 回答選択肢: テーブル名 */
    const TABLE_NAME = DbTableName::SURVEY_QUESTION_CHOICE;

    /** 回答選択肢: 対象の質問ID */
    const QUESTION_ID = 'question_id';
    /** 回答選択肢: 選択肢名 */
    const NAME = 'name';
}

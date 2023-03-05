<?php

declare(strict_types=1);

namespace App\Constants\Db\Survey;

use App\Constants\Db\DbName;
use App\Constants\Db\DbTableCommon;
use App\Constants\Db\DbTableName;

/**
 * 定数: 質問への回答
 */
class DBTableQuestionAnswer extends DbTableCommon {
    /** 質問への回答: DB名 */
    const DB_NAME = DbName::SURVEY;
    /** 質問への回答: テーブル名 */
    const TABLE_NAME = DbTableName::SURVEY_QUESTION_ANSWER;

    /** 質問への回答: 対象の質問ID */
    const QUESTION_ID = 'question_id';
    /** 質問への回答: 選んだ選択肢 */
    const QUESTION_CHOICE_ID = 'question_choice_id';
    /** 質問への回答: 記述回答の内容 */
    const TEXT = 'text';
}

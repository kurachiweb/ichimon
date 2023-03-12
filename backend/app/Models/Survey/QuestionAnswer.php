<?php

declare(strict_types=1);

namespace App\Models\Survey;

use App\Casts\CastDbPrimaryId;
use App\Constants\Db\Survey\DBTableSurveyQuestion;
use App\Constants\Db\Survey\DBTableQuestionAnswer;
use App\Constants\Db\DbConnectionName;
use App\Models\ModelCommon;

/** モデル: 質問への回答 */
class QuestionAnswer extends ModelCommon {
    /** DB接続名 */
    protected $connection = DbConnectionName::SURVEY;

    /** テーブル名 */
    protected $table = DBTableQuestionAnswer::TABLE_NAME;

    /**
     * モデルのデフォルト値
     * テーブルのカラム名・型・Not null制約に合わせる
     *
     * @var array<string, any>
     */
    protected $attributes = [
        DBTableQuestionAnswer::ID => '',
        DBTableQuestionAnswer::QUESTION_ID => '',
        DBTableQuestionAnswer::QUESTION_CHOICE_ID => '',
        DBTableQuestionAnswer::TEXT => '',
    ];

    /**
     * 取得/保存時に型を変換する
     *
     * @var array<string, string>
     */
    protected $casts = [
        DBTableQuestionAnswer::ID => CastDbPrimaryId::class,
    ];

    /**
     * アンケートの質問項目へのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question() {
        return $this->belongsTo(
            SurveyQuestion::class,
            DBTableQuestionAnswer::QUESTION_ID,
            DBTableSurveyQuestion::ID
        );
    }
}

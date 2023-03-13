<?php

declare(strict_types=1);

namespace App\Models\Survey;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Casts\CastDbPrimaryId;
use App\Constants\Db\Survey\DBTableSurveyQuestion;
use App\Constants\Db\Survey\DBTableQuestionChoice;
use App\Constants\Db\DbConnectionName;
use App\Models\ModelCommon;

/** モデル: 回答選択肢 */
class QuestionChoice extends ModelCommon {
    use HasFactory, SoftDeletes;

    /** DB接続名 */
    protected $connection = DbConnectionName::SURVEY;

    /** テーブル名 */
    protected $table = DBTableQuestionChoice::TABLE_NAME;

    /**
     * モデルのデフォルト値
     * テーブルのカラム名・型・Not null制約に合わせる
     *
     * @var array<string, any>
     */
    protected $attributes = [
        DBTableQuestionChoice::ID => '',
        DBTableQuestionChoice::QUESTION_ID => '',
        DBTableQuestionChoice::NAME => '',
    ];

    /**
     * 取得/保存時に型を変換する
     *
     * @var array<string, string>
     */
    protected $casts = [
        DBTableQuestionChoice::ID => CastDbPrimaryId::class,
    ];

    /**
     * アンケートの質問項目へのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function question() {
        return $this->belongsTo(
            SurveyQuestion::class,
            DBTableQuestionChoice::QUESTION_ID,
            DBTableSurveyQuestion::ID
        );
    }
}

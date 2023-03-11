<?php

declare(strict_types=1);

namespace App\Models\Survey;

use App\Constants\Db\Survey\DBTableSurvey;
use App\Constants\Db\Survey\DBTableSurveyQuestion;
use App\Constants\Db\DbConnectionName;
use App\Models\ModelCommon;

/** モデル: アンケートの質問項目 */
class SurveyQuestion extends ModelCommon {
    /** DB接続名 */
    protected $connection = DbConnectionName::SURVEY;

    /** テーブル名 */
    protected $table = DBTableSurveyQuestion::TABLE_NAME;

    /**
     * モデルのデフォルト値
     * テーブルのカラム名・型・Not null制約に合わせる
     *
     * @var array<string, any>
     */
    protected $attributes = [
        DBTableSurveyQuestion::ID => '',
        DBTableSurveyQuestion::SURVEY_ID => '',
        DBTableSurveyQuestion::TYPE => 0,
        DBTableSurveyQuestion::DESCRIPTION => '',
    ];

    /**
     * アンケート情報へのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function survey() {
        return $this->belongsTo(
            Survey::class,
            DBTableSurveyQuestion::SURVEY_ID,
            DBTableSurvey::ID
        );
    }
}

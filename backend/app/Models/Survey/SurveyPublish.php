<?php

declare(strict_types=1);

namespace App\Models\Survey;

use App\Constants\Db\Survey\DBTableSurvey;
use App\Constants\Db\Survey\DBTableSurveyPublish;
use App\Constants\Db\DbConnectionName;
use App\Models\ModelCommon;

/** モデル: アンケートの公開先 */
class SurveyPublish extends ModelCommon {
    /** DB接続名 */
    protected $connection = DbConnectionName::SURVEY;

    /** テーブル名 */
    protected $table = DBTableSurveyPublish::TABLE_NAME;

    /**
     * モデルのデフォルト値
     * テーブルのカラム名・型・Not null制約に合わせる
     *
     * @var array<string, any>
     */
    protected $attributes = [
        DBTableSurveyPublish::ID => '',
        DBTableSurveyPublish::SURVEY_ID => '',
        DBTableSurveyPublish::ACCOUNT_URL_ID => '',
    ];

    /**
     * アンケート情報へのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function survey() {
        return $this->belongsTo(
            Survey::class,
            DBTableSurveyPublish::SURVEY_ID,
            DBTableSurvey::ID
        );
    }
}

<?php

declare(strict_types=1);

namespace App\Models\Survey;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Casts\CastDbPrimaryId;
use App\Constants\Db\Account\DbTableAccount;
use App\Constants\Db\Survey\DBTableSurvey;
use App\Constants\Db\Survey\DBTableSurveyPublish;
use App\Constants\Db\Survey\DBTableSurveyQuestion;
use App\Constants\Db\DbConnectionName;
use App\Models\Account\Account;
use App\Models\ModelCommon;

/** モデル: アンケート情報 */
class Survey extends ModelCommon {
    use HasFactory, SoftDeletes;

    /** DB接続名 */
    protected $connection = DbConnectionName::SURVEY;

    /** テーブル名 */
    protected $table = DBTableSurvey::TABLE_NAME;

    /**
     * モデルのデフォルト値
     * テーブルのカラム名・型・Not null制約に合わせる
     *
     * @var array<string, any>
     */
    protected $attributes = [
        DBTableSurvey::ID => '',
        DBTableSurvey::ACCOUNT_ID => '',
        DBTableSurvey::TITLE => '',
        DBTableSurvey::GREETING => '',
        DBTableSurvey::DESCRIPTION => '',
        DBTableSurvey::PUBLISH_START_AT => '',
        DBTableSurvey::PUBLISH_END_AT => '',
    ];

    /**
     * 取得/保存時に型を変換する
     *
     * @var array<string, string>
     */
    protected $casts = [
        DBTableSurvey::ID => CastDbPrimaryId::class,
    ];

    /**
     * アカウント基本情報へのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account() {
        return $this->belongsTo(
            Account::class,
            DBTableSurvey::ACCOUNT_ID,
            DbTableAccount::ID
        );
    }

    /**
     * アンケートの公開先へのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function publishes() {
        return $this->hasMany(
            SurveyPublish::class,
            DBTableSurveyPublish::SURVEY_ID,
            $this->primaryKey
        );
    }

    /**
     * アンケートの質問項目へのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions() {
        return $this->hasMany(
            SurveyQuestion::class,
            DBTableSurveyQuestion::SURVEY_ID,
            $this->primaryKey
        );
    }
}

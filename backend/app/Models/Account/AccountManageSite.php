<?php

declare(strict_types=1);

namespace App\Models\Account;

use App\Casts\CastDbPrimaryId;
use App\Constants\Db\Account\DbTableAccount;
use App\Constants\Db\Account\DbTableAccountManageSite;
use App\Constants\Db\DbConnectionName;
use App\Models\Account\Account;
use App\Models\ModelCommon;

/** モデル: アカウント別のアンケート公開先サイト情報 */
class AccountManageSite extends ModelCommon {
    /** DB接続名 */
    protected $connection = DbConnectionName::ACCOUNT;

    /** テーブル名 */
    protected $table = DbTableAccountManageSite::TABLE_NAME;

    /**
     * モデルのデフォルト値
     * テーブルのカラム名・型・Not null制約に合わせる
     *
     * @var array<string, any>
     */
    protected $attributes = [
        DbTableAccountManageSite::ID => '',
        DbTableAccountManageSite::ACCOUNT_ID => '',
        DbTableAccountManageSite::TITLE => '',
        DbTableAccountManageSite::URL => '',
        DbTableAccountManageSite::SORT_PRIORITY => 0,
    ];

    /**
     * 取得/保存時に型を変換する
     *
     * @var array<string, string>
     */
    protected $casts = [
        DbTableAccountManageSite::ID => CastDbPrimaryId::class,
    ];

    /**
     * アカウント基本情報へのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account() {
        return $this->belongsTo(
            Account::class,
            DbTableAccountManageSite::ACCOUNT_ID,
            DbTableAccount::ID
        );
    }
}

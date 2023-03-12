<?php

declare(strict_types=1);

namespace App\Models\Log;

use App\Casts\CastDbPrimaryId;
use App\Constants\Db\Account\DbTableAccount;
use App\Constants\Db\DbConnectionName;
use App\Constants\Db\Log\DbTableLogAccountSecurity;
use App\Models\Account\Account;
use App\Models\ModelCommon;

/** モデル: アカウントのセキュリティログ */
class LogAccountSecurity extends ModelCommon {
    /** DB接続名 */
    protected $connection = DbConnectionName::LOG;

    /** テーブル名 */
    protected $table = DbTableLogAccountSecurity::TABLE_NAME;

    /**
     * モデルのデフォルト値
     * テーブルのカラム名・型・Not null制約に合わせる
     *
     * @var array<string, any>
     */
    protected $attributes = [
        DbTableLogAccountSecurity::ID => '',
        DbTableLogAccountSecurity::ACCOUNT_ID => '',
        DbTableLogAccountSecurity::TYPE => 0,
    ];

    /**
     * 取得/保存時に型を変換する
     *
     * @var array<string, string>
     */
    protected $casts = [
        DbTableLogAccountSecurity::ID => CastDbPrimaryId::class,
    ];

    /**
     * アカウント基本情報へのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account() {
        return $this->belongsTo(
            Account::class,
            DbTableLogAccountSecurity::ACCOUNT_ID,
            DbTableAccount::ID
        );
    }
}

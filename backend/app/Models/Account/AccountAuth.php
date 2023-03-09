<?php

declare(strict_types=1);

namespace App\Models\Account;

use App\Casts\CastEncrypt;
use App\Casts\CastHash;
use App\Casts\CastHashPassword;
use App\Constants\Db\Account\DbTableAccount;
use App\Constants\Db\Account\DbTableAccountAuth;
use App\Constants\Db\DbConnectionName;
use App\Models\Account\Account;
use App\Models\ModelCommon;

/** モデル: アカウント認証情報 */
class AccountAuth extends ModelCommon {
    /** DB接続名 */
    protected $connection = DbConnectionName::ACCOUNT;

    /** テーブル名 */
    protected $table = DbTableAccountAuth::TABLE_NAME;

    /**
     * モデルのデフォルト値
     * テーブルのカラム名・型・Not null制約に合わせる
     *
     * @var array<string, any>
     */
    protected $attributes = [
        DbTableAccountAuth::ID => '',
        DbTableAccountAuth::ACCOUNT_ID => '',
        DbTableAccountAuth::EMAIL => '',
        DbTableAccountAuth::EMAIL_HASH => '',
        DbTableAccountAuth::VERIFIED_EMAIL => 0,
        DbTableAccountAuth::PASSWORD => '',
        DbTableAccountAuth::PASSWORD_UPDATED_AT => '',
    ];

    /**
     * 取得/保存時に型を変換する
     *
     * @var array<string, string>
     */
    protected $casts = [
        DbTableAccountAuth::EMAIL => CastEncrypt::class,
        DbTableAccountAuth::EMAIL_HASH => CastHash::class,
        DbTableAccountAuth::PASSWORD => CastHashPassword::class,
    ];

    /**
     * アカウント基本情報へのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account() {
        return $this->belongsTo(
            Account::class,
            DbTableAccountAuth::ACCOUNT_ID,
            DbTableAccount::ID
        );
    }
}

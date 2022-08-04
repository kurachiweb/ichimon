<?php

declare(strict_types=1);

namespace App\Models\Account;

use App\Casts\CastEncrypt;
use App\Constants\Db\Account\DbTableAccountLoginSession;
use App\Models\Account\Account;
use App\Models\ModelCommon;

class AccountLoginSession extends ModelCommon {
    /**
     * テーブル名
     *
     * @var string
     */
    protected $table = DbTableAccountLoginSession::TABLE_NAME;

    /**
     * 取得/更新時に型を変換する
     *
     * @var array<string, string>
     */
    protected $casts = [
        DbTableAccountLoginSession::IP_ADDRESS => CastEncrypt::class,
        DbTableAccountLoginSession::USER_AGENT => CastEncrypt::class
    ];

    /**
     * アカウント基本情報へのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account() {
        return $this->belongsTo(Account::class, DbTableAccountLoginSession::ACCOUNT_ID, (new Account())->getKeyName());
    }

    /**
     * モデルのデフォルト値
     * テーブルのカラム名・型・Not null制約に合わせる
     *
     * @var array<string, any>
     */
    protected $attributes = [
        DbTableAccountLoginSession::ID => '',
        DbTableAccountLoginSession::ACCOUNT_ID => '',
        DbTableAccountLoginSession::TOKEN_HASH => '',
        DbTableAccountLoginSession::IP_ADDRESS => null,
        DbTableAccountLoginSession::USER_AGENT => null
    ];
}

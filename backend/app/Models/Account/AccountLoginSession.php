<?php

declare(strict_types=1);

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Casts\CastDbPrimaryId;
use App\Casts\CastEncrypt;
use App\Constants\Db\Account\DbTableAccount;
use App\Constants\Db\Account\DbTableAccountLoginSession;
use App\Constants\Db\DbConnectionName;
use App\Models\Account\Account;
use App\Models\ModelCommon;

/** モデル: アカウントログイン保持情報 */
class AccountLoginSession extends ModelCommon {
    use HasFactory, SoftDeletes;

    /** DB接続名 */
    protected $connection = DbConnectionName::ACCOUNT;

    /** テーブル名 */
    protected $table = DbTableAccountLoginSession::TABLE_NAME;

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
        DbTableAccountLoginSession::USER_AGENT => null,
        DbTableAccountLoginSession::LAST_LOGIN_AT => '',
    ];

    /**
     * 取得/保存時に型を変換する
     *
     * @var array<string, string>
     */
    protected $casts = [
        DbTableAccountLoginSession::ID => CastDbPrimaryId::class,
        DbTableAccountLoginSession::IP_ADDRESS => CastEncrypt::class,
        DbTableAccountLoginSession::USER_AGENT => CastEncrypt::class,
    ];

    /**
     * アカウント基本情報へのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account() {
        return $this->belongsTo(
            Account::class,
            DbTableAccountLoginSession::ACCOUNT_ID,
            DbTableAccount::ID
        );
    }
}

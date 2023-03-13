<?php

declare(strict_types=1);

namespace App\Models\Token;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Casts\CastDbPrimaryId;
use App\Casts\CastEncrypt;
use App\Constants\Db\Account\DbTableAccount;
use App\Constants\Db\Token\DbTableTokenDeleteAccount;
use App\Constants\Db\DbConnectionName;
use App\Models\Account\Account;
use App\Models\ModelCommon;

/** モデル: アカウントの削除リクエスト用トークン */
class TokenDeleteAccount extends ModelCommon {
    use HasFactory, SoftDeletes;

    /** DB接続名 */
    protected $connection = DbConnectionName::TOKEN;

    /** テーブル名 */
    protected $table = DbTableTokenDeleteAccount::TABLE_NAME;

    /**
     * モデルのデフォルト値
     * テーブルのカラム名・型・Not null制約に合わせる
     *
     * @var array<string, any>
     */
    protected $attributes = [
        DbTableTokenDeleteAccount::ID => '',
        DbTableTokenDeleteAccount::TOKEN => '',
        DbTableTokenDeleteAccount::ACCOUNT_ID => '',
    ];

    /**
     * 取得/保存時に型を変換する
     *
     * @var array<string, string>
     */
    protected $casts = [
        DbTableTokenDeleteAccount::ID => CastDbPrimaryId::class,
        DbTableTokenDeleteAccount::TOKEN => CastEncrypt::class,
    ];

    /**
     * アカウント基本情報へのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account() {
        return $this->belongsTo(
            Account::class,
            DbTableTokenDeleteAccount::ACCOUNT_ID,
            DbTableAccount::ID
        );
    }
}

<?php

declare(strict_types=1);

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Casts\CastEncrypt;
use App\Casts\CastHash;
use App\Casts\CastHashPassword;
use App\Constants\Db\Account\DbTableAccountAuth;
use App\Models\Account\Account;

/** アカウント認証情報 */
class AccountAuth extends Authenticatable {
    use HasFactory;

    /**
     * テーブル名
     *
     * @var string
     */
    protected $table = DbTableAccountAuth::TABLE_NAME;

    /**
     * IDはオートインクリメントか
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * プライマリキーの型
     *
     * @var bool
     */
    protected $keyType = 'string';

    /**
     * 追加できない列
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * 取得/更新時に型を変換する
     *
     * @var array<string, string>
     */
    protected $casts = [
        DbTableAccountAuth::EMAIL => CastEncrypt::class,
        DbTableAccountAuth::EMAIL_HASH => CastHash::class,
        DbTableAccountAuth::EMAIL_ALTER => CastEncrypt::class,
        DbTableAccountAuth::MOBILE_NO => CastEncrypt::class,
        DbTableAccountAuth::PASSWORD => CastHashPassword::class,
        DbTableAccountAuth::BILLING_TOKEN => CastEncrypt::class
    ];

    /**
     * アカウント基本情報へのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account() {
        return $this->belongsTo(Account::class, DbTableAccountAuth::ACCOUNT_ID, (new Account())->getKeyName());
    }

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
        DbTableAccountAuth::EMAIL_ALTER => null,
        DbTableAccountAuth::MOBILE_NO => null,
        DbTableAccountAuth::VERIFIED_EMAIL => 0,
        DbTableAccountAuth::VERIFIED_MOBILE_NO => 0,
        DbTableAccountAuth::PASSWORD => '',
        DbTableAccountAuth::PASSWORD_UPDATED_AT => '',
        DbTableAccountAuth::BILLING_TOKEN => null
    ];
}

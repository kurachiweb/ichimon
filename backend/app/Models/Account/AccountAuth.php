<?php

declare(strict_types=1);

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Casts\CastEncrypt;
use App\Casts\CastHash;
use App\Casts\CastHashPassword;
use App\Models\Account\Account;

/** アカウント認証情報 */
class AccountAuth extends Authenticatable {
    use HasFactory;

    /**
     * テーブル名
     *
     * @var string
     */
    protected $table = 'account_auth';

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
     * 取得できない列
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * 取得/更新時に型を変換する
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email' => CastEncrypt::class,
        'email_hash' => CastHash::class,
        'email_alter' => CastEncrypt::class,
        'mobile_no' => CastEncrypt::class,
        'password' => CastHashPassword::class,
        'billing_token' => CastEncrypt::class
    ];

    /**
     * アカウント基本情報へのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account() {
        return $this->belongsTo(Account::class, 'account_id', (new Account())->getKeyName());
    }

    /**
     * モデルのデフォルト値
     * テーブルカラム・リレーション設定と合わせる
     *
     * @return array<string, any>
     */
    public static function getDefault() {
        $model = [
            'id' => '',
            'account_id' => '',
            'email' => '',
            'email_hash' => '',
            'email_alter' => null,
            'mobile_no' => null,
            'verified_email' => 0,
            'verified_mobile_no' => 0,
            'password' => '',
            'password_updated_at' => '',
            'billing_token' => null
        ];
        return $model;
    }
}

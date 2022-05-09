<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Casts\CastEncrypt;
use App\Casts\CastHash;
use App\Casts\CastHashPassword;

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
     * プライマリキーのカラム名
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * プライマリキーの型
     *
     * @var bool
     */
    protected $keyType = 'bigint';

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
        'id' => 'int',
        'account_id' => 'int',
        'email' => CastEncrypt::class,
        'email_hash' => CastHash::class,
        'email_alter' => CastEncrypt::class,
        'password' => CastHashPassword::class,
        'password_updated_at' => 'datetime',
        'billing_token' => CastEncrypt::class,
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    /**
     * DBリレーション元
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account() {
        return $this->belongsTo('App\Models\Account', 'account_id', 'id');
    }

    /**
     * モデルのデフォルト値
     * テーブルカラム・リレーション設定と合わせる
     *
     * @param boolean $relation - リレーション先のデータも併せて設定するか
     * @return array<string, any>
     */
    public static function getDefault($relation = false) {
        $model = [
            'id' => 0,
            'account_id' => '',
            'email' => '',
            'email_hash' => '',
            'email_alter' => null,
            'verified_email' => 0,
            'verified_mobile_no' => 0,
            'password' => '',
            'password_updated_at' => '',
            'billing_token' => null
        ];
        return $model;
    }
}
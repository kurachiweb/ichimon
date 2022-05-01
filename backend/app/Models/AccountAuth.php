<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Casts\CastEncrypt;
use App\Casts\CastHash;

/** アカウント認証情報 */
class AccountAuth extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable;

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
     * 追加できる列
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'account_id',
        'email',
        'email_hash',
        'email_alter',
        'password',
        'billing_token',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * 取得できる列
     *
     * @var array<int, string>
     */
    protected $visible = [
        'id',
        'account_id',
        'email',
        'email_hash',
        'email_alter',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * 取得/更新時に型を変換する
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'int',
        'email' => CastEncrypt::class,
        'email_hash' => CastHash::class,
        'email_alter' => CastEncrypt::class,
        'password' => CastHash::class,
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
        return $this->belongsTo('App\Models\Account', 'id', $this->primaryKey);
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
            'password' => '',
            'billing_token' => null
        ];
        return $model;
    }
}

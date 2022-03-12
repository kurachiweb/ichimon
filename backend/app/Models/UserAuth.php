<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Casts\CastEncrypt;
use App\Casts\CastHash;

class UserAuth extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * テーブル名
     *
     * @var string
     */
    protected $table = 'user_auth';

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
    protected $keyType = 'bigint';

    /**
     * 追加できる列
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'user_id',
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
        'user_id',
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
        'id' => 'float', // bigintの代わり
        'email' => CastEncrypt::class,
        'email_hash' => CastHash::class,
        'email_alter' => CastEncrypt::class,
        'password' => CastHash::class,
        'billing_token' => CastEncrypt::class,
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];
}

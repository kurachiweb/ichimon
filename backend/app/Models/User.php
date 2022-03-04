<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * テーブル名
     *
     * @var string
     */
    protected $table = 'user';

    /**
     * IDはオートインクリメントでないか
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * プライマリキー型をint以外に設定
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
        'display_id',
        'name',
        'mail_address',
        'mail_address_alter',
        'password',
        'password_updated_at',
        'tel_no',
        'address',
        'address_bill'
    ];

    /**
     * 取得できる列
     *
     * @var array<int, string>
     */
    protected $visible = [
        'id',
        'display_id',
        'name'
    ];

    /**
     * 列のデータを指定型に変換する
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password_updated_at' => 'date',
        'registered_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];
}

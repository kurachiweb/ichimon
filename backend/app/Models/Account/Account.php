<?php

declare(strict_types=1);

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Models\Account\AccountAddress;
use App\Models\Account\AccountAuth;
use App\Models\Account\AccountHistory;

/** アカウント基本情報 */
class Account extends Authenticatable {
    use HasFactory;

    /**
     * テーブル名
     *
     * @var string
     */
    protected $table = 'account';

    /**
     * IDはオートインクリメントか
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * プライマリキーの型
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * 追加できない列
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'auth',
        'settings',
        'addresses'
    ];

    /**
     * アカウント履歴情報へのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function settings() {
        return $this->hasMany(AccountHistory::class, 'account_id', $this->primaryKey);
    }

    /**
     * アカウント認証情報へのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function auth() {
        return $this->hasOne(AccountAuth::class, 'account_id', $this->primaryKey);
    }

    /**
     * アカウント住所情報へのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addresses() {
        return $this->hasMany(AccountAddress::class, 'account_id', $this->primaryKey);
    }

    /**
     * モデルのデフォルト値
     * テーブルのカラム名・型・Not null制約に合わせる
     *
     * @var array<string, any>
     */
    protected $attributes = [
        'id' => '',
        'display_id' => '',
        'nickname' => '',
        'registered_at' => ''
    ];
}

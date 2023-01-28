<?php

declare(strict_types=1);

namespace App\Models\Account;

use App\Constants\Db\Account\DbTableAccount;
use App\Constants\Db\Account\DbTableAccountAddress;
use App\Constants\Db\Account\DbTableAccountAuth;
use App\Constants\Db\Account\DbTableAccountHistory;
use App\Models\Account\AccountAddress;
use App\Models\Account\AccountAuth;
use App\Models\Account\AccountHistory;
use App\Models\ModelCommon;

/** アカウント基本情報 */
class Account extends ModelCommon {
    /**
     * テーブル名
     *
     * @var string
     */
    protected $table = DbTableAccount::TABLE_NAME;

    /**
     * 追加できない列
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'auth',
        'setting',
        'addresses'
    ];

    /**
     * アカウント履歴情報へのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function setting() {
        return $this->hasOne(AccountHistory::class, DbTableAccountHistory::ACCOUNT_ID, $this->primaryKey)->latestOfMany($this->primaryKey);
    }

    /**
     * アカウント認証情報へのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function auth() {
        return $this->hasOne(AccountAuth::class, DbTableAccountAuth::ACCOUNT_ID, $this->primaryKey);
    }

    /**
     * アカウント住所情報へのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addresses() {
        return $this->hasMany(AccountAddress::class, DbTableAccountAddress::ACCOUNT_ID, $this->primaryKey);
    }

    /**
     * モデルのデフォルト値
     * テーブルのカラム名・型・Not null制約に合わせる
     *
     * @var array<string, any>
     */
    protected $attributes = [
        DbTableAccount::ID => '',
        DbTableAccount::DISPLAY_ID => '',
        DbTableAccount::NICKNAME => '',
        DbTableAccount::REGISTERED_AT => ''
    ];
}

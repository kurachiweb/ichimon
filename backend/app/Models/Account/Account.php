<?php

declare(strict_types=1);

namespace App\Models\Account;

use App\Constants\Db\Account\DbTableAccount;
use App\Constants\Db\Account\DbTableAccountAuth;
use App\Constants\Db\Account\DbTableAccountLoginSession;
use App\Constants\Db\Account\DbTableAccountManageSite;
use App\Constants\Db\Account\DbTableAccountNotification;
use App\Constants\Db\Account\DbTableAccountProfileImage;
use App\Constants\Db\Account\DbTableAccountStyling;
use App\Constants\Db\Log\DbTableLogAccountSecurity;
use App\Constants\Db\DbConnectionName;
use App\Models\Account\AccountAuth;
use App\Models\Account\AccountLoginSession;
use App\Models\Account\AccountManageSite;
use App\Models\Account\AccountNotification;
use App\Models\Account\AccountProfileImage;
use App\Models\Account\AccountStyling;
use App\Models\Log\LogAccountSecurity;
use App\Models\ModelCommon;

/** モデル: アカウント基本情報 */
class Account extends ModelCommon {
    /** DB接続名 */
    protected $connection = DbConnectionName::ACCOUNT;

    /** テーブル名 */
    protected $table = DbTableAccount::TABLE_NAME;

    /**
     * モデルのデフォルト値
     * テーブルのカラム名・型・Not null制約に合わせる
     *
     * @var array<string, any>
     */
    protected $attributes = [
        DbTableAccount::ID => '',
        DbTableAccount::NICKNAME => '',
        DbTableAccount::SELF_INTRO => '',
        DbTableAccount::REGISTERED_AT => '',
    ];

    /**
     * アカウント認証情報へのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function auth() {
        return $this->hasOne(
            AccountAuth::class,
            DbTableAccountAuth::ACCOUNT_ID,
            $this->primaryKey
        );
    }

    /**
     * アカウントログイン保持情報へのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function loginSessions() {
        return $this->hasMany(
            AccountLoginSession::class,
            DbTableAccountLoginSession::ACCOUNT_ID,
            $this->primaryKey
        );
    }

    /**
     * アンケート公開先サイト情報へのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function manageSites() {
        return $this->hasMany(
            AccountManageSite::class,
            DbTableAccountManageSite::ACCOUNT_ID,
            $this->primaryKey
        );
    }

    /**
     * アカウントの通知設定へのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function notifications() {
        return $this->hasMany(
            AccountNotification::class,
            DbTableAccountNotification::ACCOUNT_ID,
            $this->primaryKey
        );
    }

    /**
     * アカウントのプロフィール画像設定へのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function profileImages() {
        return $this->hasMany(
            AccountProfileImage::class,
            DbTableAccountProfileImage::ACCOUNT_ID,
            $this->primaryKey
        );
    }

    /**
     * アカウント表示設定へのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function styling() {
        return $this->hasOne(
            AccountStyling::class,
            DbTableAccountStyling::ACCOUNT_ID,
            $this->primaryKey
        );
    }

    /**
     * アカウントセキュリティログへのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function securityLogs() {
        return $this->hasMany(
            LogAccountSecurity::class,
            DbTableLogAccountSecurity::ACCOUNT_ID,
            $this->primaryKey
        );
    }
}

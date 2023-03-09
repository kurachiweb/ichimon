<?php

declare(strict_types=1);

namespace App\Models\Account;

use App\Constants\Db\Account\DbTableAccount;
use App\Constants\Db\Account\DbTableAccountNotification;
use App\Constants\Db\DbConnectionName;
use App\Models\Account\Account;
use App\Models\ModelCommon;

/** モデル: アカウントの通知設定 */
class AccountNotification extends ModelCommon {
    /** DB接続名 */
    protected $connection = DbConnectionName::ACCOUNT;

    /** テーブル名 */
    protected $table = DbTableAccountNotification::TABLE_NAME;

    /**
     * モデルのデフォルト値
     * テーブルのカラム名・型・Not null制約に合わせる
     *
     * @var array<string, any>
     */
    protected $attributes = [
        DbTableAccountNotification::ID => '',
        DbTableAccountNotification::ACCOUNT_ID => '',
        DbTableAccountNotification::WAY => 0,
        DbTableAccountNotification::TRIGGER => 0,
        DbTableAccountNotification::ENABLED => 0,
    ];

    /**
     * アカウント基本情報へのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account() {
        return $this->belongsTo(
            Account::class,
            DbTableAccountNotification::ACCOUNT_ID,
            DbTableAccount::ID
        );
    }
}

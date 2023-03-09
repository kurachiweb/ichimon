<?php

declare(strict_types=1);

namespace App\Models\Account;

use App\Constants\Db\Account\DbTableAccount;
use App\Constants\Db\Account\DbTableAccountStyling;
use App\Constants\Db\DbConnectionName;
use App\Models\Account\Account;
use App\Models\ModelCommon;

/** モデル: アカウント別の表示設定 */
class AccountStyling extends ModelCommon {
    /** DB接続名 */
    protected $connection = DbConnectionName::ACCOUNT;

    /** テーブル名 */
    protected $table = DbTableAccountStyling::TABLE_NAME;

    /**
     * モデルのデフォルト値
     * テーブルのカラム名・型・Not null制約に合わせる
     *
     * @var array<string, any>
     */
    protected $attributes = [
        DbTableAccountStyling::ID => '',
        DbTableAccountStyling::ACCOUNT_ID => '',
        DbTableAccountStyling::FONT_SIZE => 0,
        DbTableAccountStyling::HEADER_SIZE => 0,
        DbTableAccountStyling::LANGUAGE_ID => 0,
        DbTableAccountStyling::TIMEZONE_ID => 0,
    ];

    /**
     * アカウント基本情報へのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account() {
        return $this->belongsTo(
            Account::class,
            DbTableAccountStyling::ACCOUNT_ID,
            DbTableAccount::ID
        );
    }
}

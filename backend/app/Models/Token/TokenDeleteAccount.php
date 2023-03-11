<?php

declare(strict_types=1);

namespace App\Models\Token;

use App\Constants\Db\Account\DbTableAccount;
use App\Constants\Db\Token\DbTableTokenDeleteAccount;
use App\Constants\Db\DbConnectionName;
use App\Models\Account\Account;
use App\Models\ModelCommon;

/** モデル: アカウントの削除リクエスト用トークン */
class TokenDeleteAccount extends ModelCommon {
    /** DB接続名 */
    protected $connection = DbConnectionName::TOKEN;

    /** テーブル名 */
    protected $table = DbTableTokenDeleteAccount::TABLE_NAME;

    /**
     * モデルのデフォルト値
     * テーブルのカラム名・型・Not null制約に合わせる
     *
     * @var array<string, any>
     */
    protected $attributes = [
        DbTableTokenDeleteAccount::TOKEN => '',
        DbTableTokenDeleteAccount::ACCOUNT_ID => '',
    ];

    /**
     * アカウント基本情報へのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account() {
        return $this->belongsTo(
            Account::class,
            DbTableTokenDeleteAccount::ACCOUNT_ID,
            DbTableAccount::ID
        );
    }
}

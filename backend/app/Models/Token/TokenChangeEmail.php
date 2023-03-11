<?php

declare(strict_types=1);

namespace App\Models\Token;

use App\Constants\Db\Account\DbTableAccount;
use App\Constants\Db\Token\DbTableTokenChangeEmail;
use App\Constants\Db\DbConnectionName;
use App\Models\Account\Account;
use App\Models\ModelCommon;

/** モデル: アカウントのメールアドレス変更リクエスト用トークン */
class TokenChangeEmail extends ModelCommon {
    /** DB接続名 */
    protected $connection = DbConnectionName::TOKEN;

    /** テーブル名 */
    protected $table = DbTableTokenChangeEmail::TABLE_NAME;

    /**
     * モデルのデフォルト値
     * テーブルのカラム名・型・Not null制約に合わせる
     *
     * @var array<string, any>
     */
    protected $attributes = [
        DbTableTokenChangeEmail::TOKEN => '',
        DbTableTokenChangeEmail::ACCOUNT_ID => '',
    ];

    /**
     * アカウント基本情報へのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account() {
        return $this->belongsTo(
            Account::class,
            DbTableTokenChangeEmail::ACCOUNT_ID,
            DbTableAccount::ID
        );
    }
}

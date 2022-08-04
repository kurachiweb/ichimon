<?php

declare(strict_types=1);

namespace App\Models\Account;

use App\Constants\Db\Account\DbTableAccountVerifyEmail;
use App\Models\ModelCommon;

class VerifyEmailToken extends ModelCommon {
    /**
     * テーブル名
     *
     * @var string
     */
    protected $table = DbTableAccountVerifyEmail::TABLE_NAME;

    /**
     * プライマリキーのカラム名
     *
     * @var string
     */
    protected $primaryKey = DbTableAccountVerifyEmail::TOKEN;

    /**
     * モデルのデフォルト値
     * テーブルのカラム名・型・Not null制約に合わせる
     *
     * @var array<string, any>
     */
    protected $attributes = [
        DbTableAccountVerifyEmail::TOKEN => '',
        DbTableAccountVerifyEmail::ACCOUNT_ID => ''
    ];
}

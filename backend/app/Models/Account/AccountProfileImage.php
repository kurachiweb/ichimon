<?php

declare(strict_types=1);

namespace App\Models\Account;

use App\Casts\CastDbPrimaryId;
use App\Constants\Db\Account\DbTableAccount;
use App\Constants\Db\Account\DbTableAccountProfileImage;
use App\Constants\Db\DbConnectionName;
use App\Models\Account\Account;
use App\Models\ModelCommon;

/** モデル: アカウントのプロフィール画像設定 */
class AccountProfileImage extends ModelCommon {
    /** DB接続名 */
    protected $connection = DbConnectionName::ACCOUNT;

    /** テーブル名 */
    protected $table = DbTableAccountProfileImage::TABLE_NAME;

    /**
     * モデルのデフォルト値
     * テーブルのカラム名・型・Not null制約に合わせる
     *
     * @var array<string, any>
     */
    protected $attributes = [
        DbTableAccountProfileImage::ID => '',
        DbTableAccountProfileImage::ACCOUNT_ID => '',
        DbTableAccountProfileImage::IMAGE_URL => '',
        DbTableAccountProfileImage::SELECTED => 0,
    ];

    /**
     * 取得/保存時に型を変換する
     *
     * @var array<string, string>
     */
    protected $casts = [
        DbTableAccountProfileImage::ID => CastDbPrimaryId::class,
    ];

    /**
     * アカウント基本情報へのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account() {
        return $this->belongsTo(
            Account::class,
            DbTableAccountProfileImage::ACCOUNT_ID,
            DbTableAccount::ID
        );
    }
}

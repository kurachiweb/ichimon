<?php

declare(strict_types=1);

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Casts\CastEncrypt;
use App\Constants\Db\Account\DbTableAccountHistory;

/** アカウント履歴情報 */
class AccountHistory extends Authenticatable {
    use HasFactory;

    /**
     * テーブル名
     *
     * @var string
     */
    protected $table = DbTableAccountHistory::TABLE_NAME;

    /**
     * IDはオートインクリメントか
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * プライマリキーの型
     *
     * @var bool
     */
    protected $keyType = 'string';

    /**
     * 追加できない列
     *
     * @var array<int, string>
     */
    protected $guarded = [];

    /**
     * 取得/更新時に型を変換する
     *
     * @var array<string, string>
     */
    protected $casts = [
        DbTableAccountHistory::FIRST_NAME => CastEncrypt::class,
        DbTableAccountHistory::MIDDLE_NAME => CastEncrypt::class,
        DbTableAccountHistory::LAST_NAME => CastEncrypt::class,
    ];

    /**
     * モデルのデフォルト値
     * テーブルのカラム名・型・Not null制約に合わせる
     *
     * @var array<string, any>
     */
    protected $attributes = [
        DbTableAccountHistory::ID => '',
        DbTableAccountHistory::ACCOUNT_ID => '',
        DbTableAccountHistory::FIRST_NAME => null,
        DbTableAccountHistory::MIDDLE_NAME => null,
        DbTableAccountHistory::LAST_NAME => null,
        DbTableAccountHistory::SEX => 0,
        DbTableAccountHistory::BIRTHDAY => null
    ];
}

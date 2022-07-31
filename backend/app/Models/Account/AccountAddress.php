<?php

declare(strict_types=1);

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Casts\CastEncrypt;
use App\Constants\Db\Account\DbTableAccountAddress;

/** アカウント住所情報 */
class AccountAddress extends Authenticatable {
    use HasFactory;

    /**
     * テーブル名
     *
     * @var string
     */
    protected $table = DbTableAccountAddress::TABLE_NAME;

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
        DbTableAccountAddress::POST_CODE => CastEncrypt::class,
        DbTableAccountAddress::CITY => CastEncrypt::class,
        DbTableAccountAddress::AREA1 => CastEncrypt::class,
        DbTableAccountAddress::AREA2 => CastEncrypt::class
    ];

    /**
     * モデルのデフォルト値
     * テーブルのカラム名・型・Not null制約に合わせる
     *
     * @var array<string, any>
     */
    protected $attributes = [
        DbTableAccountAddress::ID => '',
        DbTableAccountAddress::POST_CODE => '',
        DbTableAccountAddress::COUNTRY => 0,
        DbTableAccountAddress::REGION => '',
        DbTableAccountAddress::CITY => '',
        DbTableAccountAddress::AREA1 => '',
        DbTableAccountAddress::AREA2 => '',
        DbTableAccountAddress::USE_FOR => 0
    ];
}

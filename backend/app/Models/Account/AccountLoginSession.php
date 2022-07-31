<?php

declare(strict_types=1);

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Casts\CastEncrypt;
use App\Constants\Db\Account\DbTableAccountLoginSession;
use App\Models\Account\Account;

class AccountLoginSession extends Model {
    use HasFactory;

    /**
     * テーブル名
     *
     * @var string
     */
    protected $table = DbTableAccountLoginSession::TABLE_NAME;

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
        DbTableAccountLoginSession::IP_ADDRESS => CastEncrypt::class,
        DbTableAccountLoginSession::USER_AGENT => CastEncrypt::class
    ];

    /**
     * アカウント基本情報へのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account() {
        return $this->belongsTo(Account::class, DbTableAccountLoginSession::ACCOUNT_ID, (new Account())->getKeyName());
    }

    /**
     * モデルのデフォルト値
     * テーブルのカラム名・型・Not null制約に合わせる
     *
     * @var array<string, any>
     */
    protected $attributes = [
        DbTableAccountLoginSession::ID => '',
        DbTableAccountLoginSession::ACCOUNT_ID => '',
        DbTableAccountLoginSession::TOKEN_HASH => '',
        DbTableAccountLoginSession::IP_ADDRESS => null,
        DbTableAccountLoginSession::USER_AGENT => null
    ];
}

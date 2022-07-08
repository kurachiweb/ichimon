<?php

declare(strict_types=1);

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Casts\CastEncrypt;
use App\Models\Account\Account;

class AccountLoginSession extends Model {
    use HasFactory;

    /**
     * テーブル名
     *
     * @var string
     */
    protected $table = 'account_login_session';

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
        'ip_address' => CastEncrypt::class,
        'user_agent' => CastEncrypt::class
    ];

    /**
     * アカウント基本情報へのリレーション
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function account() {
        return $this->belongsTo(Account::class, 'account_id', (new Account())->getKeyName());
    }

    /**
     * モデルのデフォルト値
     * テーブルのカラム名・型・Not null制約に合わせる
     *
     * @var array<string, any>
     */
    protected $attributes = [
        'id' => '',
        'account_id' => '',
        'token_hash' => '',
        'ip_address' => null,
        'user_agent' => null
    ];
}

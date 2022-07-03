<?php

declare(strict_types=1);

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Casts\CastEncrypt;

/** アカウント履歴情報 */
class AccountHistory extends Authenticatable {
    use HasFactory;

    /**
     * テーブル名
     *
     * @var string
     */
    protected $table = 'account_history';

    /**
     * IDはオートインクリメントか
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * プライマリキーのカラム名
     *
     * @var string
     */
    protected $primaryKey = 'id';

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
     * 取得できない列
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     * 取得/更新時に型を変換する
     *
     * @var array<string, string>
     */
    protected $casts = [
        'first_name' => CastEncrypt::class,
        'middle_name' => CastEncrypt::class,
        'last_name' => CastEncrypt::class,
    ];

    /**
     * モデルのデフォルト値
     * テーブルカラム・リレーション設定と合わせる
     *
     * @return array<string, any>
     */
    public static function getDefault() {
        $model = [
            'id' => '',
            'account_id' => '',
            'first_name' => null,
            'middle_name' => null,
            'last_name' => null,
            'sex' => 0,
            'birthday' => null
        ];
        return $model;
    }
}

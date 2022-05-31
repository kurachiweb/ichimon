<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Casts\CastEncrypt;

class AccountSession extends Model {
    use HasFactory;

    /**
     * テーブル名
     *
     * @var string
     */
    protected $table = 'account_session';

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
    protected $keyType = 'bigint';

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
        'id' => 'int',
        'account_id' => 'int',
        'ip_address' => CastEncrypt::class,
        'user_agent' => CastEncrypt::class
    ];

    /**
     * モデルのデフォルト値
     * テーブルカラム・リレーション設定と合わせる
     *
     * @param boolean $relation - リレーション先のデータも併せて設定するか
     * @return array<string, any>
     */
    public static function getDefault($relation = false) {
        $model = [
            'id' => 0,
            'account_id' => 0,
            'token_hash' => '',
            'ip_address' => null,
            'user_agent' => null,
        ];
        return $model;
    }
}

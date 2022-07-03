<?php

declare(strict_types=1);

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Casts\CastEncrypt;

/** アカウント住所情報 */
class AccountAddress extends Authenticatable {
    use HasFactory;

    /**
     * テーブル名
     *
     * @var string
     */
    protected $table = 'account_address';

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
        'post_code' => CastEncrypt::class,
        'city' => CastEncrypt::class,
        'area1' => CastEncrypt::class,
        'area2' => CastEncrypt::class
    ];

    /**
     * モデルのデフォルト値
     * テーブルカラム・リレーション設定と合わせる
     *
     * @param boolean $relation - リレーション先のデータも併せて設定するか
     * @return array<string, any>
     */
    public static function getDefault() {
        $model = [
            'id' => '',
            'post_code' => '',
            'country' => 0,
            'region' => '',
            'city' => '',
            'area1' => '',
            'area2' => '',
            'use_for' => 0,
        ];
        return $model;
    }
}

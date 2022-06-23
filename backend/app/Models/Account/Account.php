<?php

declare(strict_types=1);

namespace App\Models\Account;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Casts\CastEncrypt;
use App\Models\Account\AccountAuth;

/** アカウント基本情報 */
class Account extends Authenticatable {
    use HasFactory;

    /**
     * テーブル名
     *
     * @var string
     */
    protected $table = 'account';

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
     * @var string
     */
    protected $keyType = 'string';

    /**
     * 追加できない列
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'auth'
    ];

    /**
     * 取得できない列
     *
     * @var array<int, string>
     */
    protected $hidden = [];

    /**
     *  取得/更新時に型を変換する
     *
     * @var array<string, string>
     */
    protected $casts = [
        'tel_no' => CastEncrypt::class,
        'address' => CastEncrypt::class,
        'address_bill' => CastEncrypt::class
    ];

    /**
     * DBリレーション先
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function auth() {
        return $this->hasOne('App\Models\Account\AccountAuth', 'account_id', $this->primaryKey);
    }

    /**
     * モデルのデフォルト値
     * テーブルカラム・リレーション設定と合わせる
     *
     * @param boolean $relation - リレーション先のデータも併せて設定するか
     * @return array<string, any>
     */
    public static function getDefault($relation = false) {
        $model = [
            'id' => '',
            'display_id' => '',
            'name' => '',
            'registered_at' => '',
            'tel_no' => null,
            'mobile_no' => null,
            'address' => null,
            'address_bill' => null
        ];
        if ($relation) {
            $model['auth'] = AccountAuth::getDefault($relation);
        }
        return $model;
    }
}
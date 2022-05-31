<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifyEmailToken extends Model {
    use HasFactory;

    /**
     * テーブル名
     *
     * @var string
     */
    protected $table = 'verify_email_token';

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
    protected $primaryKey = 'token';

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
        'account_id' => 'int'
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
            'token' => '',
            'account_id' => 0
        ];
        return $model;
    }
}

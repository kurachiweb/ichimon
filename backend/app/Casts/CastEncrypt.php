<?php
declare(strict_types=1);

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

use App\Utilities\StringEncrypt;

class CastEncrypt implements CastsAttributes {
    /**
     * 復号
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     * @return string|null
     */
    public function get($model, $key, $value, $attributes) {
        return StringEncrypt::decrypt($value);
    }

    /**
     * AES-256-CBCによる可逆暗号化
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $key
     * @param string $value
     * @param array $attributes
     * @return string|null
     */
    public function set($model, $key, $value, $attributes) {
        return StringEncrypt::encrypt($value);
    }
}

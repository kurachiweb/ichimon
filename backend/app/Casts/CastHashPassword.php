<?php

declare(strict_types=1);

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

use App\Utilities\Crypto;

class CastHashPassword implements CastsAttributes {
    /**
     * そのまま取得
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     * @return string|null
     */
    public function get($model, $key, $value, $attributes) {
        return $value;
    }

    /**
     * SHA3-512によるパスワードハッシュ化
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $key
     * @param string $value
     * @param array $attributes
     * @return string|null
     */
    public function set($model, $key, $value, $attributes) {
        return Crypto::toHashPassword($value);
    }
}

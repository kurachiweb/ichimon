<?php

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class CastHashPassword implements CastsAttributes {
    /**
     * そのまま取得
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return string | null
     */
    public function get($model, $key, $value, $attributes) {
        return $value;
    }

    /**
     * SHA3-512によるパスワードハッシュ化
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  string  $value
     * @param  array  $attributes
     * @return string
     */
    public function set($model, $key, $value, $attributes) {
        if ($value === null) {
            return null;
        }
        return password_hash($value, PASSWORD_ARGON2ID);
    }
}

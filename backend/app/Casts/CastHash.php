<?php

namespace App\Casts;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class CastHash implements CastsAttributes {
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
     * SHA3-512によるハッシュ化
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
        return hash('sha3-512', $value);
    }
}
<?php

namespace App\Casts;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class CastEncrypt implements CastsAttributes {
    /**
     * 復号
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  mixed  $value
     * @param  array  $attributes
     * @return array
     */
    public function get($model, $key, $value, $attributes) {
        if ($value === null) {
            return null;
        }
        return Crypt::decryptString($value);
    }

    /**
     * AES-256-CBCによる可逆暗号化
     *
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @param  string  $key
     * @param  array  $value
     * @param  array  $attributes
     * @return string
     */
    public function set($model, $key, $value, $attributes) {
        if ($value === null) {
            return null;
        }
        return Crypt::encryptString($value);
    }
}

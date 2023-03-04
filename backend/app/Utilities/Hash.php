<?php

declare(strict_types=1);

namespace App\Utilities;

class Hash {
    /**
     * 任意文字列をハッシュ化
     *
     * @param string|null $value
     * @return string|null
     */
    public static function toHashString($value) {
        if (is_null($value)) {
            return null;
        } else if ($value === '') {
            return '';
        }
        return hash_hmac('sha3-512', $value, config('app.key'));
    }

    /**
     * パスワード文字列をハッシュ化
     *
     * @param string|null $value
     * @return string|null
     */
    public static function toHashPassword($value) {
        if (is_null($value)) {
            return null;
        } else if ($value === '') {
            return '';
        }
        return password_hash($value, PASSWORD_ARGON2ID);
    }
}

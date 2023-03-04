<?php

declare(strict_types=1);

namespace App\Utilities;

use ArrayObject;

class ExpandedIdToken extends ArrayObject {
    public ?string $id = null;
    public ?string $token = null;
}

class BundleIdToken {
    /**
     * Idとトークン文字列を結合
     */
    public static function bundle(?string $id, ?string $token): string {
        $bundler = ['id' => $id, 'token' => $token];
        return json_encode($bundler);
    }

    /**
     * Idとトークン文字列を分解
     */
    public static function expand(?string $joined): ExpandedIdToken {
        $expanded = new ExpandedIdToken();
        if (is_string($joined)) {
            // 配列としてデコード
            $decoded = json_decode($joined, true);
            if (is_array($decoded)) {
                $expanded['id'] = $decoded['id'];
                $expanded['token'] = $decoded['token'];
            }
        }
        return $expanded;
    }
}

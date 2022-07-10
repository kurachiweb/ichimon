<?php

declare(strict_types=1);

namespace App\Stores;

use Illuminate\Support\Facades\Redis;

use App\UseCases\Account\AccountGetCase;

class AccountStore {
    /**
     * 保存領域からアカウント情報を取得
     *
     * @param string $account_id
     * @return array|null
     */
    public static function get($account_id) {
        $redis = Redis::connection('account');
        
        $account = $redis->get($account_id);

        // 取得データが文字でない場合は、decodeできないためそのまま返す
        if (!is_string($account)) {
            return $account;
        }
        return json_decode($account, true);
    }

    /**
     * 保存領域にアカウント情報を保存
     *
     * @param string $account_id
     * @return array
     */
    public static function save($account_id) {
        $redis = Redis::connection('account');

        // DBにアクセスしてアカウント情報を取得する
        $accountGetCase = new AccountGetCase();
        $account = $accountGetCase($account_id, true)->toArray();

        // アカウント情報用キャッシュに接続し、保存する
        // Redisには配列をそのまま入れられないため文字列化
        $redis->set($account_id, json_encode($account));

        return $account;
    }
}

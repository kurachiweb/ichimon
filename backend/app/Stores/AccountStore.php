<?php

declare(strict_types=1);

namespace App\Stores;

use Illuminate\Support\Facades\Redis;

use App\Constants\ConstBackend;
use App\Constants\Db\Account\DbTableAccount;

class AccountStore {
    /**
     * 接続中のRedisインスタンス
     *
     * @var \Illuminate\Redis\Connections\Connection
     */
    public $_redis;

    /**
     * Redisに接続
     */
    public function __construct() {
        $this->_redis = Redis::connection('account');
    }

    /**
     * キャッシュからアカウント情報を取得
     */
    public function get(string $account_id): ?array {
        $account_raw = $this->_redis->get($account_id);
        if (!is_string($account_raw)) {
            // 対象IDのアカウント情報が得られなかった場合は空
            return null;
        }

        $res_account = json_decode($account_raw, true);
        if (!is_array($res_account)) {
            // 不正形式に起因してデコード結果が配列にならなかった場合は空
            return null;
        }

        // 該当データの保存期限を延ばす
        $this->_redis->expire($account_id, ConstBackend::CACHE_ACCOUNT_EXPIRATION);

        return $res_account;
    }

    /**
     * キャッシュにアカウント情報を保存
     */
    public function save(array $account): array {
        // アカウント情報用キャッシュに接続し、保存する
        // Redisには配列をそのまま入れられないため文字列化
        $this->_redis->setEx($account[DbTableAccount::ID], ConstBackend::CACHE_ACCOUNT_EXPIRATION, json_encode($account));

        return $account;
    }

    /**
     * キャッシュのアカウント情報を削除(アカウント基本ID指定)
     */
    public function delete(string $account_id) {
        return $this->_redis->delete($account_id);
    }
}

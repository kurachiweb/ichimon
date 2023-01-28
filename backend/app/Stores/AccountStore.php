<?php

declare(strict_types=1);

namespace App\Stores;

use Illuminate\Support\Facades\Redis;

use App\Constants\ConstBackend;
use App\Constants\Db\Account\DbTableAccount;
use App\UseCases\Account\AccountGetCase;

class AccountStore {
    /** Redisインスタンス */
    public $_redis;

    /**
     * Redisに接続
     *
     * @return void
     */
    public function __construct() {
        $this->_redis = Redis::connection('account');
    }

    /**
     * 保存領域からアカウント情報を取得
     *
     * @param string $account_id
     * @return array|null
     */
    public function get($account_id) {
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
        $this->_redis->expire($account_id, ConstBackend::REDIS_ACCOUNT_EXPIRATION);

        return $res_account;
    }

    /**
     * 保存領域にアカウント情報を保存
     *
     * @param array $account
     * @return array
     */
    public function save($account) {
        // アカウント情報用キャッシュに接続し、保存する
        // Redisには配列をそのまま入れられないため文字列化
        $this->_redis->setEx($account[DbTableAccount::ID], ConstBackend::REDIS_ACCOUNT_EXPIRATION, json_encode($account));

        return $account;
    }

    /**
     * 保存領域のアカウント情報を削除(アカウント基本ID指定)
     *
     * @param string $account_id
     * @return int
     */
    public function delete($account_id) {
        // 指定基本IDのアカウント情報を削除する
        return $this->_redis->delete($account_id);
    }
}

<?php

declare(strict_types=1);

namespace App\Stores;

use Illuminate\Support\Facades\Redis;

use App\Constants\ConstBackend;
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
        $res_account = null;

        if (is_null($account_raw)) {
            // 対象IDのアカウント情報が無かった場合は、新たに保存する
            $res_account = $this->saveById($account_id);
        } else if (is_string($account_raw)) {
            // 対象IDのアカウント情報が得られたら、デコードする
            $res_account = json_decode($account_raw, true);
            // 保存領域にて、該当データの有効期限を延ばす
            $this->_redis->expire($account_id, ConstBackend::REDIS_ACCOUNT_EXPIRATION);
        }

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
        $this->_redis->setEx($account['id'], ConstBackend::REDIS_ACCOUNT_EXPIRATION, json_encode($account));

        return $account;
    }

    /**
     * 保存領域にアカウント情報を保存(アカウント基本ID指定)
     *
     * @param string $account_id
     * @return array
     */
    public function saveById($account_id) {
        // DBにアクセスしてアカウント情報を取得する
        $accountGetCase = new AccountGetCase();
        $account = $accountGetCase($account_id, true, true)->toArray();

        // アカウント情報用キャッシュに接続し、保存する
        $this->save($account);

        return $account;
    }
}

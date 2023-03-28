<?php

declare(strict_types=1);

namespace App\Services\Account;

use App\Repositories\Account\AccountGetRepository;
use App\Stores\AccountStore;

class AccountGetService {
    /**
     * 接続中のRedisインスタンス
     *
     * @var \Illuminate\Redis\Connections\Connection
     */
    private $store;

    /**
     * アカウント情報を取得する
     *
     * @return \App\Models\Account\Account|null
     */
    public function do(string $req_account_id): ?array {
        // まずはキャッシュを見る
        $account_stored = $this->getCache($req_account_id);
        if (is_array($account_stored)) {
            return $account_stored;
        }

        // 無ければDBから取得する
        $account = (new AccountGetRepository())($req_account_id, true);
        if (!isset($account)) {
            return null;
        }
        $res_account = $account->toArray();

        // DBから得たアカウント情報を、キャッシュに保存
        $this->saveCache($res_account);

        return $res_account;
    }

    /**
     * アカウント情報をキャッシュから取得する
     */
    public function getCache(string $req_account_id): ?array {
        if (!isset($this->store)) {
            $this->store = new AccountStore();
        }
        $res_account = $this->store->get($req_account_id);

        return $res_account;
    }

    /**
     * アカウント情報をキャッシュに保存する
     */
    public function saveCache(array $req_account) {
        if (!isset($this->store)) {
            $this->store = new AccountStore();
        }
        $this->store->save($req_account);
    }
}

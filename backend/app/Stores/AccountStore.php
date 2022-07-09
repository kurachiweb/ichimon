<?php

declare(strict_types=1);

namespace App\Stores;

use Illuminate\Support\Facades\Session;

use App\UseCases\Account\AccountGetCase;

class AccountStore {
    /**
     * セッションからアカウント情報を取得
     *
     * @param string $account_id
     */
    public static function get($account_id) {
        // セッションに保存されたアカウント情報を取り出す
        return Session::get('account' . $account_id);
    }

    /**
     * セッションにアカウント情報を保存
     *
     * @param string $account_id
     * @return array
     */
    public static function save($account_id) {
        // DBにアクセスしてアカウント情報を取得する
        $accountGetCase = new AccountGetCase();
        $account = $accountGetCase($account_id, true)->toArray();

        // このリクエスト限りのセッションに保存
        Session::now('account' . $account_id, $account);

        return $account;
    }
}

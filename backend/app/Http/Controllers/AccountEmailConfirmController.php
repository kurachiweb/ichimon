<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\AccountRequest;
use App\Services\Account\AccountEmailConfirmService;
use App\UseCases\Account\AccountAuthGetCase;

class AccountEmailConfirmController extends Controller {
    /**
     * 指定IDのアカウントがメールアドレス未認証なら、認証メールを送る
     *
     * @param \Illuminate\Http\Request $request
     * @param mixed $id
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $id) {
        // リクエストパラメータのアカウント基本IDを入力チェック(Guard側で確認済み)
        $req_account_id = AccountRequest::toAccountId($id);

        // DBにアクセスして更新対象アカウント情報を取得する
        $accountAuthGetCase = new AccountAuthGetCase();
        $account_auth = $accountAuthGetCase($req_account_id);

        // アカウントメールアドレスの認証メールを送り、ステータスを変更する
        $account_auth = AccountEmailConfirmService::confirm($account_auth->toArray());

        return response()->success(['send' => true]);
    }
}

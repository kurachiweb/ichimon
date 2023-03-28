<?php

declare(strict_types=1);

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\AccountRequest;
use App\Services\Account\AccountEmailConfirmService;

class AccountEmailConfirmController extends Controller {
    /**
     * 指定IDのアカウントがメールアドレス未認証なら、認証メールを送る
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $id) {
        // リクエストパラメータのアカウント基本IDを入力チェック(Guard側で確認済み)
        $req_account_id = AccountRequest::toAccountId($id);

        // アカウントメールアドレスの認証メールを送り、ステータスを変更する
        (new AccountEmailConfirmService())->do($req_account_id);

        return response()->success(['send' => true]);
    }
}

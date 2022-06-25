<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\AccountRequest;
use App\UseCases\Account\AccountCreateCase;
use App\UseCases\Account\AccountDeleteCase;
use App\UseCases\Account\AccountGetCase;
use App\UseCases\Account\AccountListCase;
use App\UseCases\Account\AccountUpdateCase;
use App\Utilities\ValidateRequest;

class AccountController extends Controller {
    /**
     * 一覧取得
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        // DBにアクセスしてアカウント一覧を取得する
        $accountListCase = new AccountListCase();
        $res_accounts = $accountListCase();

        return response()->success(['accounts' => $res_accounts]);
    }

    /**
     * 1人作成
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // リクエスト中のアカウント基本情報を入力チェック
        $req = ValidateRequest::json($request, new AccountRequest());

        $req_account = $req['account'];

        // DBにアクセスしてアカウントを作成する
        $accountCreateCase = new AccountCreateCase();
        $res_account = $accountCreateCase($req_account);

        return response()->successCreate(['account' => $res_account]);
    }

    /**
     * 1人取得
     *
     * @param mixed $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        // リクエストパラメータのアカウント基本IDを入力チェック(Guard側で確認済み)
        $req_account_id = AccountRequest::toAccountId($id);

        // DBにアクセスしてアカウントを取得する
        $accountGetCase = new AccountGetCase();
        $res_account = $accountGetCase($req_account_id);

        return response()->success(['account' => $res_account]);
    }

    /**
     * 1人更新
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        // リクエスト中のアカウント基本情報を入力チェック
        $req = ValidateRequest::json($request, new AccountRequest());

        // リクエストボディのアカウント基本情報
        $req_account = $req['account'];

        // DBにアクセスしてアカウントを更新する
        $accountUpdateCase = new AccountUpdateCase();
        $accountUpdateCase($req_account);

        return response()->success();
    }

    /**
     * 1人削除
     *
     * @param mixed $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        // リクエストパラメータのアカウント基本IDを入力チェック(Guard側で確認済み)
        $req_account_id = AccountRequest::toAccountId($id);

        // DBにアクセスしてアカウントを削除する
        $accountDeleteCase = new AccountDeleteCase();
        $accountDeleteCase($req_account_id);

        return response()->success();
    }
}

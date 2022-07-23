<?php

declare(strict_types=1);

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\AccountCreateRequest;
use App\Http\Requests\Account\AccountRequest;
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
        $res_accounts = (new AccountListCase())();

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
        $req = ValidateRequest::json($request, new AccountCreateRequest());

        // リクエストボディのアカウント作成情報
        $req_account = $req;

        // DBにアクセスしてアカウントを作成する
        $res_account = (new AccountCreateCase())($req_account);

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
        $res_account = (new AccountGetCase())($req_account_id, true);

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
        (new AccountUpdateCase())($req_account);

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
        (new AccountDeleteCase())($req_account_id);

        return response()->success();
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\AccountCreateRequest;
use App\Http\Requests\Account\AccountRequest;
use App\Services\Account\AccountCreateService;
use App\Services\Account\AccountDeleteService;
use App\Services\Account\AccountGetService;
use App\Services\Account\AccountListService;
use App\Services\Account\AccountUpdateService;
use App\Utilities\KeysOnly;
use App\Utilities\ValidateRequest;

class AccountController extends Controller {
    /**
     * 一覧取得
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        // DBにアクセスしてアカウント一覧を取得する
        $res_accounts = (new AccountListService())->do();

        return response()->success(['accounts' => $res_accounts]);
    }

    /**
     * 1人作成
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        // リクエスト中のアカウント基本情報を入力チェック
        $req = ValidateRequest::json($request, new AccountCreateRequest());

        // リクエストボディのアカウント作成情報
        $req_account = KeysOnly::select($req, [
            'nickname',
            'self_intro',
            'email',
            'password',
        ]);

        $res_account = (new AccountCreateService())->do($req_account);

        return response()->successCreate(['account' => $res_account]);
    }

    /**
     * 1人取得
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        // リクエストパラメータのアカウント基本IDを入力チェック(Guard側で確認済み)
        $req_account_id = AccountRequest::toAccountId($id);

        $res_account = (new AccountGetService())->do($req_account_id);

        return response()->success(['account' => $res_account]);
    }

    /**
     * 1人更新
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        // リクエスト中のアカウント基本情報を入力チェック
        $req = ValidateRequest::json($request, new AccountRequest());

        // リクエストボディのアカウント情報
        $req_account = KeysOnly::select($req, [
            'nickname',
            'self_intro',
            'profile_image',
        ]);

        // DBにアクセスしてアカウントを更新する
        (new AccountUpdateService())->do($req_account);

        return response()->success();
    }

    /**
     * 1人削除
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        // リクエストパラメータのアカウント基本IDを入力チェック(Guard側で確認済み)
        $req_account_id = AccountRequest::toAccountId($id);

        // DBにアクセスしてアカウントを削除する
        (new AccountDeleteService())->do($req_account_id);

        return response()->success();
    }
}

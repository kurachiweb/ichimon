<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests\AccountRequest;
use App\Models\Account;
use App\Models\AccountAuth;
use App\Utilities\Random;
use App\Utilities\ValidateRequest;

class AccountController extends Controller {
    /**
     * 一覧取得
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $account = Account::all(['id', 'display_id', 'name', 'registered_at']);
        return response()->json([
            'message' => 'Successful',
            'data' => $account
        ], 200, [], JSON_UNESCAPED_UNICODE);
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

        $account = Account::getDefault(true);
        $account_auth = $account['auth'];

        $now = Carbon::now('UTC');
        $account_id = Random::dbPrimaryId();
        $account_auth_id = Random::dbPrimaryId();

        // アカウント基本情報をリクエスト内容で上書き
        $account['id'] = $account_id;
        $account['display_id'] = $req_account['display_id'];
        $account['registered_at'] = $now;

        // アカウント認証情報をリクエスト内容で上書き
        $account_auth['id'] = $account_auth_id;
        $account_auth['account_id'] = $account_id;
        $account_auth['email'] = $req_account['auth']['email'];
        $account_auth['email_hash'] = $req_account['auth']['email'];
        $account_auth['password'] = $req_account['auth']['password'];
        $account_auth['password_updated_at'] = $now;

        $res_account = Account::create($account);
        $res_account_auth = AccountAuth::create($account_auth);
        $res_account = $res_account->toArray();
        $res_account['auth'] = $res_account_auth->toArray();
        return response()->json([
            'message' => 'Successful',
            'data' => [
                'account' => $res_account,
            ]
        ], 201, [], JSON_UNESCAPED_UNICODE);
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

        // アカウント基本IDからアカウントを取得
        $account = Account::findOrFail($req_account_id);
        $account_auth = $account->auth;
        $account = $account->toArray();
        $account['auth'] = $account_auth;

        return response()->json([
            'message' => 'Successful',
            'data' => [
                'account' => $account
            ]
        ], 200, [], JSON_UNESCAPED_UNICODE);
    }

    /**
     * 1人更新
     *
     * @param \Illuminate\Http\Request $request
     * @param mixed $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        // リクエスト中のアカウント基本情報を入力チェック
        $req = ValidateRequest::json($request, new AccountRequest());

        // リクエストボディのアカウント基本情報
        $req_account = $req['account'];

        // リクエストパラメータのアカウント基本IDを入力チェック(Guard側で確認済み)
        $req_account_id = AccountRequest::toAccountId($id);

        // 更新対象のアカウント
        $account = Account::findOrFail($req_account_id);

        // 上書きするデータを限定する
        $account['display_id'] = $req_account['display_id'];
        $account['name'] = $req_account['name'];
        $account['tel_no'] = $req_account['tel_no'];
        $account['address'] = $req_account['address'];
        $account['address_bill'] = $req_account['address_bill'];

        // 上書きを反映する
        $account->saveOrFail();

        return response()->json([
            'message' => 'Successful',
        ], 200);
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

        // 削除対象のアカウント
        $account = Account::findOrFail($req_account_id);
        $account_auth = $account->auth;
        if (!isset($account_auth)) {
            return response()->json([
                'message' => 'Not found',
            ], 404);
        }

        // リレーション制約エラーにならない順番で削除
        $account_auth->delete();
        $account->delete();

        return response()->json([
            'message' => 'Successful',
        ], 200);
    }
}

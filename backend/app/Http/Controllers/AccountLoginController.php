<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

use App\Constants\ConstBackend;
use App\Models\Account;
use App\Models\AccountAuth;
use App\Models\AccountSession;
use App\Utilities\BundleIdToken;
use App\Utilities\Crypto;
use App\Utilities\Random;

class AccountLoginController extends Controller {
    /**
     * アカウントにログインする
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request) {
        $body = $request->getContent();
        $req = json_decode($body, true);
        if (!isset($req['name'])) {
            return response()->json([
                'message' => 'Need request \'name\'',
            ], 404);
        }
        if (!isset($req['password'])) {
            return response()->json([
                'message' => 'Need request \'password\'',
            ], 404);
        }

        // ログインリクエスト情報において空文字列やnullを許容しない
        $req_name = $req['name'];
        $req_password = $req['password'];
        if (is_null($req_name) || $req_name === '') {
            return response()->json([
                'message' => 'require \'name\'',
            ], 401);
        }
        if (is_null($req_password) || $req_password === '') {
            return response()->json([
                'message' => 'require \'password\'',
            ], 401);
        }

        // @が2文字目以降にあればメールアドレス扱い
        $is_email = true;
        if (strpos($req_name, '@', 1) === false) {
            // @が無いか1文字目なら表示用ID扱い
            $is_email = false;
        }

        // メールアドレスまたは表示用IDに一致するアカウントを取得
        $account = null;
        $account_auth = null;
        if ($is_email) {
            $account_auth = AccountAuth::where('email_hash', Crypto::toHashString($req_name))->first();
        } else {
            $account = Account::where('display_id', $req_name)->first();
        }
        if ($account) {
            $account_auth = $account->auth;
        } else if ($account_auth) {
            $account = $account_auth->account;
        }

        // アカウントが存在するか
        if (!$account || !$account_auth) {
            return response()->json([
                'message' => 'Not match \'account\'',
            ], 401);
        }

        // そのアカウントのパスワードが一致するか
        $match_password = password_verify($req_password, $account_auth['password']);
        if (!$match_password) {
            return response()->json([
                'message' => 'Not match \'account\'',
            ], 401);
        }

        // ログイントークンを生成
        $token = bin2hex(random_bytes(48));
        $bundled_id_token = BundleIdToken::bundle($account['id'], $token);

        // ハッシュ化したログイントークンをDBに保存
        $account_session = AccountSession::getDefault(false);
        $account_session['id'] = Random::dbPrimaryId();
        $account_session['account_id'] = $account['id'];
        $account_session['token_hash'] = Crypto::toHashPassword($bundled_id_token);
        $account_session['ip_address'] = $request->ip();
        $account_session['user_agent'] = $request->userAgent();

        $added_session = AccountSession::create($account_session);
        $added_session = $added_session->toArray();
        if (!$added_session) {
            return response()->json([
                'message' => 'Cannot add account session',
            ], 404);
        }

        // ログイン状態を保持するため、Cookieを設定
        // 有効期限は24時間・基本的にnot secure・http-only
        Cookie::queue(ConstBackend::COOKIE_NAME_LOGIN_TOKEN, $bundled_id_token, config('session.lifetime'), '/', '', config('session.secure', true), true);
        return response()->json([
            'message' => 'Successful',
            'data' => [
                'account_id' => $account['id'],
                'login' => true,
            ]
        ], 201, [], JSON_UNESCAPED_UNICODE);
    }
}

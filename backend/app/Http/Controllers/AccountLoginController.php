<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Casts\CastHash;
use App\Models\Account;
use App\Models\AccountAuth;

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
        $req_name = $req['name'];
        $req_password = $req['password'];

        // @が2文字目以降にあればメールアドレス扱い
        $is_email = true;
        if (strpos($req_name, '@', 1) === false) {
            // @が無いか1文字目なら表示用ID扱い
            $is_email = false;
        }

        // メールアドレスまたは表示用IDに一致するアカウントを取得
        $_CastHash = new CastHash();
        $account_auth = null;
        logger($req_name);
        if ($is_email) {2
            $account_auth = AccountAuth::where('email_hash', $_CastHash->set(null, '', $req_name, []))->first();
        } else {
            $account = Account::where('display_id', $req_name)->first();
            logger($account);
            if ($account) {
                $account_auth = $account->auth;
            }
            logger($account->auth);
        }
        logger($account_auth);
        if (!isset($account_auth)) {
            return response()->json([
                'message' => 'Not found \'account\'',
            ], 404);
        }

        // そのアカウントのパスワードが一致するか
        $match_password = password_verify($req_password, $account_auth['password']);
        if (!$match_password) {
            return response()->json([
                'message' => 'Not found \'account\'',
            ], 404);
        }

        // ログイントークンを発行

        // ハッシュ化したログイントークンをDBに保存

        // if (!$auth_saved) {
        //     return response()->json([
        //         'message' => 'Cannot Update',
        //     ], 404);
        // }
        return response()->json([
            'message' => 'Successful',
            'data' => [
                'login' => true,
            ]
        ], 201, [], JSON_UNESCAPED_UNICODE);
    }
}

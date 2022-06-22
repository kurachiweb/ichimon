<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Constants\ConstBackend;
use App\Models\Account;
use App\Models\VerifyEmailToken;

class AccountEmailVerifyController extends Controller {
    /**
     * メール認証トークンを照合できれば、アカウントのメール認証ステータスを更新
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request) {
        $body = $request->getContent();
        $req = json_decode($body, true);
        if (!isset($req['token'])) {
            return response()->json([
                'message' => 'Need request \'token\'',
            ], 404);
        }
        $req_token = $req['token'];

        // トークンを照合
        // 主キーがトークン
        $token_column = VerifyEmailToken::findOrFail($req_token);
        $now = Carbon::now('UTC');
        $token_created = $token_column['created_at'];
        // トークンが作られてから一定時間が経過していれば、認証しない
        if ($token_created->diffInSeconds($now) > ConstBackend::ACCOUNT_VERIFY_EXPIRE_SECOND) {
            return response()->json([
                'message' => 'Token expired',
            ], 401);
        }

        // メールアドレスを認証したのでステータスを変更
        $account_id = $token_column['account_id'];
        $account = Account::findOrFail($account_id);
        $account_auth = $account->auth;
        $account_auth['verified_email'] = ConstBackend::ACCOUNT_VERIFY_VERIFY;
        $account_auth->saveOrFail();

        return response()->json([
            'message' => 'Successful',
            'data' => [
                'verify' => true,
            ]
        ], 201, [], JSON_UNESCAPED_UNICODE);
    }
}
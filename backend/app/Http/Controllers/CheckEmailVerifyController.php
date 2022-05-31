<?php
declare(strict_types=1);

namespace App\Http\Controllers;

use DateTimeZone;
use Illuminate\Http\Request;

use App\Constants\ConstBackend;
use App\Models\Account;
use App\Models\VerifyEmailToken;

class CheckEmailVerifyController extends Controller {
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
        $token_column = VerifyEmailToken::find($req_token);
        if (!isset($token_column)) {
            return response()->json([
                'message' => 'Not found token',
            ], 404);
        }
        $now = date_create('now', new DateTimeZone('UTC'));
        $token_created = $token_column['created_at'];
        if ($now - $token_created > ConstBackend::ACCOUNT_VERIFY_EXPIRE_SECOND) {
            return response()->json([
                'message' => 'Token expired',
            ], 401);
        }
        
        // メールアドレスを認証したのでステータスを変更
        $account_id = $token_column['account_id'];
        $account = Account::find($account_id);
        if (!$account) {
            return response()->json([
                'message' => 'Not found',
            ], 404);
        }
        $account_auth = $account->auth;
        $account_auth['verified_email'] = ConstBackend::ACCOUNT_VERIFY_VERIFY;
        $auth_saved = $account_auth->save();
        if (!$auth_saved) {
            return response()->json([
                'message' => 'Cannot Update',
            ], 404);
        }
        return response()->json([
            'message' => 'Successful',
            'data' => [
                'verify' => true,
            ]
        ], 201, [], JSON_UNESCAPED_UNICODE);
    }
}

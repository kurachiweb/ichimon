<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;

use App\Constants\ConstBackend;
use App\Models\Account;
use App\Models\VerifyEmailToken;
use App\Mail\AccountEmailVerify;

class AccountEmailConfirmController extends Controller {
    /**
     * 指定IDのアカウントが未認証なら、認証メールを送る
     *
     * @param \Illuminate\Http\Request $request
     * @param mixed $id
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, $id) {
        // リクエストパラメータのアカウント基本IDを入力チェック(Guard側で確認済み)
        $req_account_id = (int)$id;

        // 更新するアカウント
        $account = Account::findOrFail($req_account_id);
        $account_auth = $account->auth;

        // メールアドレスの検証対象か
        if ($account_auth['verified_email'] === ConstBackend::ACCOUNT_VERIFY_VERIFY) {
            // 認証済みなら何もしない
            return response()->json([
                'message' => 'Already Verified',
            ], 404);
        }

        // トークンを作成し、DBに保存する
        $token = Str::uuid()->toString(); // UUIDv4
        $verify_record = VerifyEmailToken::getDefault(false);
        $verify_record['token'] = $token;
        $verify_record['account_id'] = $req_account_id;
        $verify_saved = VerifyEmailToken::create($verify_record);
        if (!$verify_saved) {
            return response()->json([
                'message' => 'Cannot Save Token',
            ], 404);
        }

        // メールアドレスを送信する
        $mail_address = $account_auth['email'];
        Mail::to($mail_address)->send(new AccountEmailVerify($token));

        // 認証メールの送信フラグを送信済みにする
        $account_auth['verified_email'] = ConstBackend::ACCOUNT_VERIFY_SEND;
        $account_auth->saveOrFail();

        return response()->json([
            'message' => 'Successful',
            'data' => [
                'send' => true,
            ]
        ], 201, [], JSON_UNESCAPED_UNICODE);
    }
}

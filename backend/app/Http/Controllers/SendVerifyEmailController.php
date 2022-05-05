<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Mail;
use App\Models\Account;
use App\Constants\ConstBackend;
use App\Mail\AccountEmailVerify;

class SendVerifyEmailController extends Controller {
    /**
     * 指定IDのアカウントが未認証なら、認証メールを送る
     *
     * @param int $account_id
     * @return \Illuminate\Http\Response
     */
    public function __invoke($account_id) {
        if (!isset($account_id)) {
            return response()->json([
                'message' => 'Need request \'account_id\'',
            ], 404);
        }

        // 更新するアカウント
        $account = Account::find($account_id);
        if (!$account) {
            return response()->json([
                'message' => 'Not found',
            ], 404);
        }
        $account_auth = $account->auth;

        // メールアドレスの検証対象か
        if ($account_auth['verified_email'] === ConstBackend::ACCOUNT_VERIFY_VERIFY) {
            // 認証済みなら何もしない
            return response()->json([
                'message' => 'Already Verified',
            ], 404);
        }

        // メールアドレスを送信する
        $mail_address = $account_auth['email'];
        Mail::to($mail_address)->send(new AccountEmailVerify('テスト'));

        // 認証メールの送信フラグを送信済みにする
        $account_auth['verified_email'] = ConstBackend::ACCOUNT_VERIFY_SEND;
        $successSaved = $account_auth->save();

        if (!$successSaved) {
            return response()->json([
                'message' => 'Cannot Update',
            ], 404);
        }
        return response()->json([
            'message' => 'Successful',
            'data' => [
                'send' => true,
            ]
        ], 201, [], JSON_UNESCAPED_UNICODE);
    }
}

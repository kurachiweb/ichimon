<?php

declare(strict_types=1);

namespace App\Services\Account;

use Illuminate\Support\Facades\Mail;

use App\Constants\ConstBackend;
use App\Mail\AccountEmailVerify;
use App\UseCases\Account\AuthVerifyEmailUpdateCase;
use App\UseCases\Account\EmailTokenCreateCase;

class AccountEmailConfirmService {
    /**
     * アカウントメールアドレスの認証メールを送り、ステータスを変更する
     *
     * @param array $account_auth
     * @return array
     */
    public static function confirm($account_auth) {
        // メールアドレスの検証対象か
        if ($account_auth['verified_email'] === ConstBackend::ACCOUNT_VERIFY_VERIFY) {
            // 認証済みなら何もしない
            return $account_auth;
        }

        // トークンを作成し、DBに保存する
        $res_email_token = (new EmailTokenCreateCase())($account_auth['account_id']);

        // メールアドレスを送信する
        $mail_address = $account_auth['email'];
        Mail::to($mail_address)->send(new AccountEmailVerify($res_email_token['token']));

        // 認証メールの送信フラグを送信済みにする
        $account_auth['verified_email'] = ConstBackend::ACCOUNT_VERIFY_SEND;
        (new AuthVerifyEmailUpdateCase())($account_auth);

        return $account_auth;
    }
}

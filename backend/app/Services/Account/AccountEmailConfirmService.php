<?php

declare(strict_types=1);

namespace App\Services\Account;

use Illuminate\Support\Facades\Mail;

use App\Constants\ConstBackend;
use App\Constants\Db\Account\DbTableAccountAuth;
use App\Constants\Db\Token\DbTableTokenChangeEmail;
use App\Mail\AccountEmailVerify;
use App\Repositories\Account\AccountEmailVerifyUpdateRepository;
use App\Repositories\Account\AccountGetRepository;
use App\Repositories\Token\AccountChangeEmailCreateRepository;

class AccountEmailConfirmService {
    /**
     * アカウントメールアドレスの認証メールを送り、ステータスを変更する
     */
    public function do(string $req_account_id): array {
        // 更新対象アカウント情報を取得する
        $account = (new AccountGetRepository())($req_account_id);
        if (!isset($account)) {
            return null;
        }
        $account_auth = $account->auth->toArray();

        // メールアドレスの検証対象か
        if ($account_auth[DbTableAccountAuth::VERIFIED_EMAIL] === ConstBackend::ACCOUNT_VERIFY_VERIFY) {
            // 認証済みなら何もしない
            return $account_auth;
        }

        // トークンを作成し、DBに保存する
        $res_email_token = (new AccountChangeEmailCreateRepository())($account_auth[DbTableAccountAuth::ACCOUNT_ID]);

        // メールアドレスを送信する
        $mail_address = $account_auth[DbTableAccountAuth::EMAIL];
        Mail::to($mail_address)->send(new AccountEmailVerify($res_email_token[DbTableTokenChangeEmail::TOKEN]));

        // 認証メールの送信フラグを送信済みにする
        $account_auth[DbTableAccountAuth::VERIFIED_EMAIL] = ConstBackend::ACCOUNT_VERIFY_SEND;
        (new AccountEmailVerifyUpdateRepository())($account_auth);

        return $account_auth;
    }
}

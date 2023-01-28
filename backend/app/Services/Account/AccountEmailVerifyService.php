<?php

declare(strict_types=1);

namespace App\Services\Account;

use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response as HttpResponse;

use App\Constants\ConstBackend;
use App\Constants\Db\Account\DbTableAccountAuth;
use App\Constants\Db\Account\DbTableAccountVerifyEmail;
use App\Models\Account\VerifyEmailToken;
use App\UseCases\Account\AccountAuthGetCase;
use App\UseCases\Account\AuthVerifyEmailUpdateCase;

class AccountEmailVerifyService {
    /**
     * アカウントメールアドレスの認証を完了する
     *
     * @param string $req_token
     */
    public static function verify($req_token) {
        // 主キーとなっているトークンで検索する
        $email_token = VerifyEmailToken::findOrFail($req_token);

        $now = Carbon::now(config('app.timezone'));
        $token_created = $email_token[DbTableAccountVerifyEmail::CREATED_AT];

        // トークンが作られてから一定時間が経過していれば、認証エラー
        if ($token_created->diffInSeconds($now) > ConstBackend::ACCOUNT_VERIFY_EXPIRATION) {
            throw new AuthorizationException('Token expired.', HttpResponse::HTTP_UNAUTHORIZED);
        }

        // DBにアクセスして更新対象のアカウント認証情報を取得する
        $req_account_id = $email_token[DbTableAccountVerifyEmail::ACCOUNT_ID];
        $account_auth = (new AccountAuthGetCase())($req_account_id);

        // メールアドレスを認証したのでステータスを変更
        $account_auth[DbTableAccountAuth::VERIFIED_EMAIL] = ConstBackend::ACCOUNT_VERIFY_VERIFY;
        (new AuthVerifyEmailUpdateCase())($account_auth->toArray());
    }
}

<?php

declare(strict_types=1);

namespace App\Services\Account;

use Carbon\Carbon;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response as HttpResponse;

use App\Constants\ConstBackend;
use App\Constants\Db\Account\DbTableAccountAuth;
use App\Constants\Db\Token\DbTableTokenChangeEmail;
use App\Models\Token\TokenChangeEmail;
use App\Repositories\Account\AccountAuthGetRepository;
use App\Repositories\Account\AccountEmailVerifyUpdateRepository;

class AccountEmailVerifyService {
    /**
     * アカウントメールアドレスの認証を完了する
     *
     * @throws AuthorizationException
     */
    public function do(string $req_token) {
        // 主キーとなっているトークンで検索する
        $email_token = TokenChangeEmail::find($req_token);
        if (!isset($email_token)) {
            throw new AuthorizationException('Token mot match.', HttpResponse::HTTP_UNAUTHORIZED);
        }

        $now = Carbon::now(config('app.timezone'));
        $token_created = $email_token[DbTableTokenChangeEmail::CREATED_AT];

        // トークンが作られてから一定時間が経過していれば、認証エラー
        if ($token_created->diffInSeconds($now) > ConstBackend::ACCOUNT_VERIFY_EXPIRATION) {
            throw new AuthorizationException('Token expired.', HttpResponse::HTTP_UNAUTHORIZED);
        }

        // DBにアクセスして更新対象のアカウント認証情報を取得する
        $req_account_id = $email_token[DbTableTokenChangeEmail::ACCOUNT_ID];
        $account_auth = (new AccountAuthGetRepository())($req_account_id);

        // メールアドレスを認証したのでステータスを変更
        $account_auth[DbTableAccountAuth::VERIFIED_EMAIL] = ConstBackend::ACCOUNT_VERIFY_VERIFY;
        (new AccountEmailVerifyUpdateRepository())($account_auth->toArray());
    }
}

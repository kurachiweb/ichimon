<?php

declare(strict_types=1);

namespace App\UseCases\Account;

use App\Constants\Db\Account\DbTableAccountVerifyEmail;
use App\Constants\Db\DbTableTokenCommon;
use App\Models\Account\VerifyEmailToken;
use App\Utilities\Random;

class EmailTokenCreateCase {
    /**
     * アカウントメールアドレス認証トークン作成
     *
     * @return \App\Models\Account\VerifyEmailToken
     */
    public function __invoke(string $req_account_id) {
        // トークンとなるランダム文字列
        $token = Random::generateString(DbTableTokenCommon::TOKEN_LENGTH);

        $verify_email_token = (new VerifyEmailToken())->toArray();
        $verify_email_token[DbTableAccountVerifyEmail::TOKEN] = $token;
        $verify_email_token[DbTableAccountVerifyEmail::ACCOUNT_ID] = $req_account_id;
        return VerifyEmailToken::create($verify_email_token);
    }
}

<?php

declare(strict_types=1);

namespace App\Repositories\Token;

use App\Constants\Db\Token\DbTableTokenChangeEmail;
use App\Constants\Db\DbTableTokenCommon;
use App\Models\Token\TokenChangeEmail;
use App\Utilities\Random;

class AccountChangeEmailCreateRepository {
    /**
     * アカウントメールアドレス認証トークン作成
     *
     * @return \App\Models\Token\TokenChangeEmail
     */
    public function __invoke(string $req_account_id) {
        // トークンとなるランダム文字列
        $token = Random::generateString(DbTableTokenCommon::TOKEN_LENGTH);

        $verify_email_token = (new TokenChangeEmail())->toArray();
        $verify_email_token[DbTableTokenChangeEmail::TOKEN] = $token;
        $verify_email_token[DbTableTokenChangeEmail::ACCOUNT_ID] = $req_account_id;
        return TokenChangeEmail::create($verify_email_token);
    }
}

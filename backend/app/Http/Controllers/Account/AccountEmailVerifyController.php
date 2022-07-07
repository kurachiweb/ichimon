<?php

declare(strict_types=1);

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\AccountEmailVerifyRequest;
use App\Services\Account\AccountEmailVerifyService;
use App\Utilities\ValidateRequest;

class AccountEmailVerifyController extends Controller {
    /**
     * メール認証トークンを照合できれば、アカウントのメール認証ステータスを更新
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request) {
        // リクエスト中の認証トークンを入力チェック
        $req = ValidateRequest::json($request, new AccountEmailVerifyRequest());

        // トークンを照合し、アカウントメールアドレスの認証を完了する
        AccountEmailVerifyService::verify($req['token']);

        return response()->success();
    }
}

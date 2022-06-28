<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\AccountLoginRequest;
use App\Services\Account\AccountLoginService;
use App\Utilities\ValidateRequest;

class AccountLoginController extends Controller {
    /**
     * アカウントにログインする
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request) {
        // リクエスト中のログイン情報を入力チェック
        $req = ValidateRequest::json($request, new AccountLoginRequest());

        // アカウントにログインする
        AccountLoginService::verify($req['name'], $req['password'], $request->ip(), $request->userAgent());

        return response()->success();
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use App\Constants\ConstBackend;
use App\Stores\AccountStore;
use App\Utilities\BundleIdToken;

class StoreAccount {
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next) {
        $this->save($request);

        return $next($request);
    }

    /**
     * Determine if the user is logged in to any of the given guards.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    protected function save(Request $request) {
        // Cookieの保存値からアカウント基本IDを取得
        $cookie_id_token_stringify = $request->cookie(ConstBackend::COOKIE_NAME_LOGIN_TOKEN);
        $cookie_id_token = BundleIdToken::expand($cookie_id_token_stringify);
        $cookie_account_id = $cookie_id_token['id'];

        if (isset($cookie_account_id)) {
            // 後続の処理でアカウント情報を利用できるように、セッションに保存
            AccountStore::save($cookie_account_id);
        }
    }
}

<?php

declare(strict_types=1);

namespace App\Guards;

use Illuminate\Auth\GuardHelpers as GuardHelpers;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

use App\Constants\ConstBackend;
use App\Models\Account\AccountLoginSession;
use App\Providers\AccountProvider;
use App\Rules\DbPrimaryValidation;
use App\Utilities\BundleIdToken;
use App\Utilities\ValidateVariable;

/**
 * アカウントにログインしているか(認可)
 */
class AccountAuthZGuard implements Guard {
    use GuardHelpers;

    protected AccountProvider $_provider;
    protected ?Request $_request;
    protected ?AccountLoginSession $_account_session;

    /**
     * Create a new authentication guard.
     */
    public function __construct(string $name, AccountProvider $provider, Request $request = null) {
        $this->_request = $request;
        $this->_provider = $provider;
        $this->_account_session = null;
    }

    /**
     * Determine if the current account is authenticated.
     *
     * @return bool
     */
    public function check() {
        return !is_null($this->user());
    }

    /**
     * Get the currently authenticated account.
     *
     * @return Authenticatable|null
     */
    public function user() {
        if (!is_null($this->_account_session)) {
            return $this->_account_session;
        }

        // Cookieの保存値からアカウントIDとログイントークンを取得
        $cookie_id_token_stringify = $this->_request->cookie(ConstBackend::COOKIE_ACCOUNT_LOGIN_NAME);
        $cookie_id_token = BundleIdToken::expand($cookie_id_token_stringify);
        $cookie_account_id = $cookie_id_token['id'];
        $cookie_account_token = $cookie_id_token['token'];

        // Cookie保存値のIDがアカウント基本ID形式か判定
        // トークンが文字列か判定
        $validator = ValidateVariable::make([
            [$cookie_account_id, 'required', new DbPrimaryValidation()],
            [$cookie_account_token, 'required', 'string']
        ]);
        if ($validator->fails()) {
            return null;
        }

        // トークン文字列による認可セッション特定
        $this->_account_session = $this->_provider->retrieveByToken($cookie_account_id, $cookie_account_token);

        return $this->_account_session;
    }

    /**
     * Validate a account's credentials.
     *
     * @return bool
     */
    public function validate(array $credentials = []) {
        return false;
    }
}

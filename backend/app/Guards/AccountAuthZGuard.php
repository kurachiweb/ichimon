<?php

declare(strict_types=1);

namespace App\Guards;

use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Auth\GuardHelpers as GuardHelpers;

use App\Constants\ConstBackend;
use App\Models\AccountSession;
use App\Utilities\BundleIdToken;

/**
 * アカウントにログインしているか(認可)
 */
class AccountAuthZGuard implements Guard {
  use GuardHelpers;

  protected string $_name;
  protected UserProvider $_provider;
  protected ?Request $_request;
  protected ?AccountSession $_account_session;

  /**
   * Create a new authentication guard.
   *
   * @param string $name
   * @param UserProvider $provider
   * @param Request $request
   */
  public function __construct(string $name, UserProvider $provider, Request $request = null) {
    $this->_name = $name;
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
    $cookie_id_token = $this->_request->cookie(ConstBackend::COOKIE_NAME_LOGIN_TOKEN);
    $cookie_id_token_map = BundleIdToken::expand($cookie_id_token);
    $cookie_account_id = $cookie_id_token_map['id'];
    $cookie_account_token = $cookie_id_token_map['token'];

    // リクエストパラメータやCookie保存値においてnullは許容しない
    if (is_null($cookie_account_id) || is_null($cookie_account_token)) {
      return null;
    }

    $this->_account_session = $this->_provider->retrieveByToken($cookie_account_id, $cookie_account_token);

    return $this->_account_session;
  }

  /**
   * Validate a account's credentials.
   *
   * @param array $credentials
   * @return bool
   */
  public function validate(array $credentials = []) {
    return false;
  }
}

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
 * ログインアカウントを認証できるか
 */
class AccountAuthRGuard implements Guard {
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
    return $this->user();
  }

  /**
   * Get the currently authenticated account.
   *
   * @return Authenticatable|null
   */
  public function user() {
    // cookieに保存されているアカウントIDを取得
    $id_token = $this->_request->cookie(ConstBackend::COOKIE_NAME_LOGIN_TOKEN);
    $id_token_map = BundleIdToken::split($id_token);

    // リクエストURLのアカウントIDと一致していれば、認証できたと見なす
    $req_account_id = (int)$this->_request->route('account');
    $cookie_account_id = $id_token_map['id'];

    return $req_account_id === $cookie_account_id;
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

<?php

declare(strict_types=1);

namespace App\Guards;

use Illuminate\Auth\GuardHelpers as GuardHelpers;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Http\Request;

use App\Constants\ConstBackend;
use App\Http\Requests\Account\AccountRequest;
use App\Providers\AccountProvider;
use App\Rules\DbPrimaryStringValidation;
use App\Utilities\BundleIdToken;
use App\Utilities\ValidateVariable;

/**
 * ログインアカウントを認証できるか
 */
class AccountAuthRGuard implements Guard {
  use GuardHelpers;

  protected ?Request $_request;

  /**
   * Create a new authentication guard.
   *
   * @param string $name
   * @param AccountProvider $provider
   * @param Request $request
   */
  public function __construct(string $name, AccountProvider $provider, Request $request = null) {
    $this->_request = $request;
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
    // Cookieに保存されているアカウントIDを取得
    $cookie_id_token_stringify = $this->_request->cookie(ConstBackend::COOKIE_NAME_LOGIN_TOKEN);
    $cookie_id_token = BundleIdToken::expand($cookie_id_token_stringify);

    $req_account_id_raw = $this->_request->route('account');
    $cookie_account_id = $cookie_id_token['id'];
    $req_account_id = AccountRequest::toAccountId($req_account_id_raw);

    // リクエストパラメータ/Cookie保存値のIDがアカウント基本ID形式か判定
    $validator = ValidateVariable::make([
      [$req_account_id, 'required', new DbPrimaryStringValidation()],
      [$cookie_account_id, 'required', new DbPrimaryStringValidation()]
    ]);
    if ($validator->fails()) {
      return null;
    }

    // リクエストURLのアカウントIDと一致していれば、認証できたと見なす
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

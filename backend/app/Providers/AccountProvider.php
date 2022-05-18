<?php

namespace App\Providers;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use App\Models\AccountSession;
use App\Utilities\BundleIdToken;

class AccountProvider implements UserProvider {
  /**
   * Retrieve a user by their unique identifier.
   *
   * @see \Illuminate\Contracts\Auth\UserProvider::retrieveById
   * @param  mixed  $identifier
   * @return \Illuminate\Contracts\Auth\Authenticatable|null
   */
  public function retrieveById($identifier) {
    return null;
  }

  /**
   * Retrieve a user by their unique identifier and "remember me" token.
   *
   * @see \Illuminate\Contracts\Auth\UserProvider::retrieveByToken
   * @param  mixed  $identifier
   * @param  string  $token
   * @return \Illuminate\Contracts\Auth\Authenticatable|null
   */
  public function retrieveByToken($identifier, $token) {
    $_BundleIdToken = new BundleIdToken();
    $account_session = AccountSession::where('account_id', $identifier)->first();
    // そのアカウントIDでのセッション履歴が存在しない
    if (!$account_session) {
      return null;
    }
    // アカウントのトークンが一致しない
    $id_token = $_BundleIdToken->join($identifier, $token);
    $savedTokenHash = $account_session['token_hash'];
    if (!password_verify($id_token, $savedTokenHash)) {
      return null;
    }
    return $account_session;
  }

  /**
   * Update the "remember me" token for the given user in storage.
   *
   * @see \Illuminate\Contracts\Auth\UserProvider::updateRememberToken
   * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
   * @param  string  $token
   * @return void
   */
  public function updateRememberToken(Authenticatable $user, $token) {
  }

  /**
   * Retrieve a user by the given credentials.
   *
   * @see \Illuminate\Contracts\Auth\UserProvider::retrieveByCredentials
   * @param  array  $credentials
   * @return \Illuminate\Contracts\Auth\Authenticatable|null
   */
  public function retrieveByCredentials(array $credentials) {
    return null;
  }

  /**
   * Validate a user against the given credentials.
   *
   * @see \Illuminate\Contracts\Auth\UserProvider::validateCredentials
   * @param  \Illuminate\Contracts\Auth\Authenticatable  $user
   * @param  array  $credentials
   * @return bool
   */
  public function validateCredentials(Authenticatable $user, array $credentials) {
    return false;
  }
}

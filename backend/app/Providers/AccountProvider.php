<?php

declare(strict_types=1);

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
   * @param int|null $identifier
   * @param string|null $token
   * @return \Illuminate\Contracts\Auth\Authenticatable|null
   */
  public function retrieveByToken($identifier, $token) {
    // cookieの格納値が不正で、アカウントIDを取り出しできなければ、アカウントセッションを返さない
    if (!$identifier) {
      return null;
    }
    // coolieの格納値が無いか空文字で、トークン文字列がnullまたは空文字になる場合も、アカウントセッションを返さない
    if (!$token) {
      return null;
    }

    // 指定アカウントIDでのセッション履歴を全て取得
    $account_sessions = AccountSession::where('account_id', $identifier)->orderBy('created_at', 'desc')->get();
    // そのアカウントIDでのセッション履歴が存在しない
    if (!$account_sessions) {
      return null;
    }
    // 比較元のセッションID
    $id_token = BundleIdToken::join($identifier, $token);
    // 一致したログインセッション
    $match_session = null;

    foreach ($account_sessions as $account_session) {
      // 比較先のセッションID
      $saved_token_hash = $account_session['token_hash'];
      // トークンが一致すれば、そのセッションを返す
      if (password_verify($id_token, $saved_token_hash)) {
        $match_session = $account_session;
        break;
      }
    }
    return $match_session;
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

/*+ リクエスト：アカウントログイン */
export interface ReqLoginAccount {
  name?: string; // アカウントID、またはメールアドレス
  password?: string; // パスワード
}

/*+ レスポンス：アカウントログイン */
export interface ResLoginAccount {
  account_id?: string; // ログインしたアカウントID
}

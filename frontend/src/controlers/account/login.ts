/*+ リクエスト：アカウントログイン */
export interface ReqLoginAccount {
  name?: string; // アカウントID、またはメールアドレス
  password?: string; // パスワード
}

/*+ レスポンス：アカウントログイン */
export interface ResLoginAccount {
  account_id?: number; // ログインしたアカウントID
  login?: boolean; // ログインに成功したか
}

/*+ リクエスト：アカウントログイン */
export interface ReqLoginAccount {
  name: string | null; // アカウントID、またはメールアドレス
  password: string | null; // パスワード
}

/*+ レスポンス：アカウントログイン */
export interface ResLoginAccount {
  account_id?: string; // ログインしたアカウントID
}

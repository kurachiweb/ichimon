/*+ リクエスト：アカウントメールアドレスの認証メール送信 */
export interface ReqSendEmail {
  account_id?: string; // 対象のアカウントID
}

/*+ レスポンス：アカウントメールアドレスの認証メール送信 */
export interface ResSendEmail {
  send?: boolean; // 送信処理を問題なく終えたか
}

/*+ リクエスト：アカウントメールアドレスの認証 */
export interface ReqVerifyEmail {
  token?: string; // メールアドレスの認証トークン
}

/*+ レスポンス：アカウントメールアドレスの認証 */
export interface ResVerifyEmail {
  verify?: boolean; // 認証に成功したか
}

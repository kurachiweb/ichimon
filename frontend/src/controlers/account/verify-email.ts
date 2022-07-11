import { FetchApiJson, Origin } from '@/controlers/_connect/fetch';

/*+ リクエスト：アカウントメールアドレスの認証メール送信 */
export interface ReqAccountEmailConfirm {
  account_id: string; // 対象のアカウントID
}

/*+ レスポンス：アカウントメールアドレスの認証メール送信 */
export interface ResAccountEmailConfirm {
  send: boolean; // 送信処理を問題なく終えたか
}

/*+ リクエスト：アカウントメールアドレスの認証 */
export interface ReqAccountEmailVerify {
  token: string; // メールアドレスの認証トークン
}

/*+ レスポンス：アカウントメールアドレスの認証 */
export interface ResAccountEmailVerify {
  verify: boolean; // 認証に成功したか
}

/** アカウントのメールアドレス認証リクエストを送信 */
export const requestAccountEmailConfirm = (
  accountId: string
): Promise<ResAccountEmailConfirm | null> => {
  return new Promise(resolve => {
    return FetchApiJson<ReqAccountEmailConfirm, ResAccountEmailConfirm>(
      Origin.backend + '/api/accounts/' + accountId + '/email/confirm'
    ).then(res => {
      resolve(res.data);
    });
  });
};

/** アカウントのメールアドレス認証完了リクエストを送信 */
export const requestAccountEmailVerify = (
  accountId: number,
  token: string
): Promise<ResAccountEmailVerify | null> => {
  return new Promise(resolve => {
    FetchApiJson<ReqAccountEmailVerify, ResAccountEmailVerify>(
      Origin.backend + '/api/accounts/' + accountId + '/email/verify',
      { token }
    ).then(res => {
      resolve(res.data);
    });
  });
};

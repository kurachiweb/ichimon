import { FetchApiJson, Origin } from '@/controlers/_connect/fetch';

/*+ リクエスト：アカウントログイン */
export interface ReqLoginAccount {
  name: string | null; // アカウントID、またはメールアドレス
  password: string | null; // パスワード
}

/*+ レスポンス：アカウントログイン */
export interface ResLoginAccount {
  account_id?: string; // ログインしたアカウントID
}

/** アカウントのログインリクエストを送信 */
export const requestLoginAccount = (
  name: string | null,
  password: string | null
): Promise<ResLoginAccount | undefined> => {
  return new Promise(resolve => {
    FetchApiJson<ReqLoginAccount, ResLoginAccount>(
      Origin.backend + '/api/accounts/login',
      { name, password }
    ).then(res => {
      resolve(res.data);
    });
  });
};

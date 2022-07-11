import { FetchApiJson, Origin } from '@/controlers/_connect/fetch';
import { Account } from '@/models/account/account';

/*+ リクエスト：アカウント作成 */
export interface ReqCreateAccount {
  account: Account;
}

/*+ レスポンス：アカウント作成 */
export interface ResCreateAccount {
  account: Account;
}

/** アカウントの作成リクエストを送信 */
export const requestCreateAccount = (
  account: Account
): Promise<ResCreateAccount | null> => {
  return new Promise(resolve => {
    FetchApiJson<ReqCreateAccount, ResCreateAccount>(Origin.backend + '/api/accounts', {
      account
    }).then(res => {
      resolve(res.data);
    });
  });
};

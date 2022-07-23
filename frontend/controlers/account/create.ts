import { FetchApiJson, Origin } from '@/controlers/_connect/fetch';
import { Account } from '@/models/account/account';

/*+ リクエスト：アカウント作成 */
export interface ReqCreateAccount {
  nickname: string;
  email: string;
  password: string;
}

/*+ レスポンス：アカウント作成 */
export interface ResCreateAccount {
  account: Account;
}

/*+ アカウント作成入力のデフォルト値 */
export const DefaultReqCreateAccount = (): ReqCreateAccount => ({
  nickname: '',
  email: '',
  password: ''
});

/** アカウントの作成リクエストを送信 */
export const requestCreateAccount = (
  account: ReqCreateAccount
): Promise<ResCreateAccount | null> => {
  return new Promise(resolve => {
    FetchApiJson<ReqCreateAccount, ResCreateAccount>(
      Origin.backend + '/api/accounts',
      account
    ).then(res => {
      resolve(res.data);
    });
  });
};

import { FetchApiJson, Origin } from '@/controlers/_connect/fetch';
import { Account } from '@/models/account/account';

/*+ リクエスト：アカウント一覧取得 */
export interface ReqListAccount {
  order: number;
  order_by: number;
}

/*+ レスポンス：アカウント一覧取得 */
export interface ResListAccount {
  accounts: Account[];
}

/** アカウントの一覧取得リクエストを送信 */
export const requestListingAccount = (
  searchCond?: ReqListAccount
): Promise<ResListAccount | null> => {
  return new Promise(resolve => {
    FetchApiJson<ReqListAccount, ResListAccount>(
      Origin.backend + '/api/accounts',
      searchCond,
      { method: 'GET' }
    ).then(res => {
      resolve(res.data);
    });
  });
};

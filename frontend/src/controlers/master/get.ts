import { FetchApiJson, Origin } from '@/controlers/_connect/fetch';
import { Master } from '@/types/master';

/*+ レスポンス：アカウント一覧取得 */
export interface ResListAccount {
  masters: Master;
}

/** マスタ情報取得リクエストを送信 */
export const requestGetMaster = (): Promise<ResListAccount | undefined> => {
  return new Promise(resolve => {
    FetchApiJson<null, ResListAccount>(Origin.backend + '/api/masters', null, {
      method: 'GET'
    }).then(res => {
      resolve(res.data);
    });
  });
};

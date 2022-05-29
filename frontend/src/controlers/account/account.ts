import { Account } from '@/models/account/account';

/*+ リクエスト：アカウント基本情報 */
export interface ReqGetAccount {
  account?: Account;
}

/*+ レスポンス：アカウント基本情報 */
export interface ResGetAccount {
  account?: Account;
}

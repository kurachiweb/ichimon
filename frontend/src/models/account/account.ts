import { ColumnBase, DefaultColumnBase } from '@/models/db-base';
import { AccountHistory, DefaultAccountHistory } from '@/models/account/history';
import { AccountAuth, DefaultAccountAuth } from '@/models/account/auth';
import { AccountAddress, DefaultAccountAddress } from '@/models/account/address';

/*+ アカウント基本情報 */
export interface Account extends ColumnBase {
  auth: AccountAuth | null;
  settings: AccountHistory[] | null;
  addresses: AccountAddress[] | null;
  id: string;
  display_id: string;
  nickname: string;
  registered_at: string;
}

/*+ アカウント基本情報のデフォルト値 */
export const DefaultAccount = (relation: boolean): Account => ({
  settings: relation ? [DefaultAccountHistory()] : null,
  auth: relation ? DefaultAccountAuth() : null,
  addresses: relation ? [DefaultAccountAddress()] : null,
  id: '',
  display_id: '',
  nickname: '',
  registered_at: '',
  ...DefaultColumnBase()
});

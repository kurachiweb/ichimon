import { ColumnBase, DefaultColumnBase } from '@/models/db-base';
import { AccountAuth, DefaultAccountAuth } from '@/models/account/auth';

/*+ アカウント基本情報 */
export interface Account extends ColumnBase {
  auth: AccountAuth;
  id: number;
  display_id: string;
  name: string;
  registered_at: string;
  password_updated_at: string;
  tel_no: string | null;
  mobile_no: string | null;
  address: string | null;
  address_bill: string | null;
}

/*+ アカウント基本情報のデフォルト値 */
export const DefaultAccount = (): Account => ({
  auth: DefaultAccountAuth(),
  id: 0,
  display_id: '',
  name: '',
  registered_at: '',
  password_updated_at: '',
  tel_no: null,
  mobile_no: null,
  address: null,
  address_bill: null,
  ...DefaultColumnBase()
});

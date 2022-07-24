import { ColumnBase, DefaultColumnBase } from '@/models/db-base';

/*+ アカウント履歴情報 */
export interface AccountHistory extends ColumnBase {
  id: string;
  account_id: string;
  first_name: string | null;
  middle_name: string | null;
  last_name: string | null;
  sex: number;
  birthday: string;
}

/*+ アカウント履歴情報のデフォルト値 */
export const DefaultAccountHistory = (): AccountHistory => ({
  id: '',
  account_id: '',
  first_name: null,
  middle_name: null,
  last_name: null,
  sex: 0,
  birthday: '',
  ...DefaultColumnBase()
});

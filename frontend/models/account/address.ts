import { ColumnBase, DefaultColumnBase } from '@/models/db-base';

/*+ アカウント住所情報 */
export interface AccountAddress extends ColumnBase {
  id: string;
  account_id: string;
  post_code: string;
  country: number;
  region: string;
  city: string | null;
  area1: string | null;
  area2: string | null;
  use_for: number;
}

/*+ アカウント住所情報のデフォルト値 */
export const DefaultAccountAddress = (): AccountAddress => ({
  id: '',
  account_id: '',
  post_code: '',
  country: 0,
  region: '',
  city: null,
  area1: null,
  area2: null,
  use_for: 0,
  ...DefaultColumnBase()
});

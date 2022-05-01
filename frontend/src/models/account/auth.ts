import { ColumnBase, DefaultColumnBase } from '@/models/db-base';

/*+ アカウント認証情報 */
export interface AccountAuth extends ColumnBase {
  id: number;
  user_id: string;
  email: string;
  email_hash: string;
  email_alter: string | null;
  password: string;
  billing_token: string | null;
}

/*+ アカウント認証情報のデフォルト値 */
export const DefaultAccountAuth = (): AccountAuth => ({
  id: 0,
  user_id: '',
  email: '',
  email_hash: '',
  email_alter: null,
  password: '',
  billing_token: null,
  ...DefaultColumnBase()
});

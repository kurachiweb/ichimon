import { ColumnBase, DefaultColumnBase } from '@/models/db-base';

/*+ アカウント認証情報 */
export interface AccountAuth extends ColumnBase {
  id: string;
  account_id: string;
  email: string;
  email_hash: string;
  email_alter: string | null;
  verified_email: number;
  verified_mobile_no: number;
  password: string;
  password_updated_at: string;
  billing_token: string | null;
}

/*+ アカウント認証情報のデフォルト値 */
export const DefaultAccountAuth = (): AccountAuth => ({
  id: '',
  account_id: '',
  email: '',
  email_hash: '',
  email_alter: null,
  verified_email: 0,
  verified_mobile_no: 0,
  password: '',
  password_updated_at: '',
  billing_token: null,
  ...DefaultColumnBase()
});

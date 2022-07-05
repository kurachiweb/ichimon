import { FetchApiJson, Origin } from '@/controlers/_connect/fetch';
import { ReqLoginAccount, ResLoginAccount } from '@/controlers/account/login';
import { Account } from '@/models/account/account';
import { ReqSendEmail, ResSendEmail } from '@/controlers/account/verify-email';

/*+ リクエスト：アカウント基本情報 */
export interface ReqGetAccount {
  account?: Account;
}

/*+ レスポンス：アカウント基本情報 */
export interface ResGetAccount {
  account?: Account;
}

/** アカウントの作成リクエストを送信 */
export const requestAccountCreate = (account: Account): Promise<Account | undefined> => {
  return new Promise(resolve => {
    FetchApiJson<ReqGetAccount, ResGetAccount>(Origin.backend + '/api/accounts', {
      account
    }).then(res => {
      resolve(res.data?.account);
    });
  });
};

/** アカウントのログインリクエストを送信 */
export const requestAccountLogin = (
  name: string | null,
  password: string | null
): Promise<ResLoginAccount | undefined> => {
  return new Promise(resolve => {
    FetchApiJson<ReqLoginAccount, ResLoginAccount>(
      Origin.backend + '/api/accounts/login',
      { name, password }
    ).then(res => {
      resolve(res.data);
    });
  });
};

/** アカウントのメールアドレス認証リクエストを送信 */
export const requestAccountEmailVerify = (accountId: string) => {
  FetchApiJson<ReqSendEmail, ResSendEmail>(
    Origin.backend + '/api/accounts/' + accountId + '/email/confirm'
  );
};

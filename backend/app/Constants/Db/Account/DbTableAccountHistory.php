<?php

declare(strict_types=1);

namespace App\Constants\Db\Account;

use App\Constants\Db\DbTableCommon;

/**
 * 定数：アカウント履歴情報のカラム名
 */
class DbTableAccountHistory extends DbTableCommon {
  /** アカウント履歴情報：テーブル名 */
  const TABLE_NAME = 'account_history';

  /** アカウント履歴情報：対象のアカウントID */
  const ACCOUNT_ID = 'account_id';
  /** アカウント履歴情報：利用者姓 */
  const FIRST_NAME = 'first_name';
  /** アカウント履歴情報：利用者ミドルネーム */
  const MIDDLE_NAME = 'middle_name';
  /** アカウント履歴情報：利用者名 */
  const LAST_NAME = 'last_name';
  /** アカウント履歴情報：性別 */
  const SEX = 'sex';
  /** アカウント履歴情報：生年月日 */
  const BIRTHDAY = 'birthday';
}

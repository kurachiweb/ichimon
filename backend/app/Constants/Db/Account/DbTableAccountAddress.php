<?php

declare(strict_types=1);

namespace App\Constants\Db\Account;

use App\Constants\Db\DbTableCommon;

/**
 * 定数：アカウント利用者住所情報のカラム名
 */
class DbTableAccountAddress extends DbTableCommon {
  /** アカウント利用者住所情報：テーブル名 */
  const TABLE_NAME = 'account_address';

  /** アカウント利用者住所情報：対象のアカウントID */
  const ACCOUNT_ID = 'account_id';
  /** アカウント利用者住所情報：郵便番号 */
  const POST_CODE = 'post_code';
  /** アカウント利用者住所情報：国コード */
  const COUNTRY = 'country';
  /** アカウント利用者住所情報：都道府県（国によっては州など） */
  const REGION = 'region';
  /** アカウント利用者住所情報：市区町村郡に相当 */
  const CITY = 'city';
  /** アカウント利用者住所情報：住所1行目（丁目・番地など） */
  const AREA1 = 'area1';
  /** アカウント利用者住所情報：住所2行目（建物名・部屋番号など） */
  const AREA2 = 'area2';
  /** アカウント利用者住所情報：住所の利用目的 */
  const USE_FOR = 'use_for';
}

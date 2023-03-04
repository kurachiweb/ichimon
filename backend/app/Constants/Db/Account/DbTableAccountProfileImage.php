<?php

declare(strict_types=1);

namespace App\Constants\Db\Account;

use App\Constants\Db\DbName;
use App\Constants\Db\DbTableCommon;
use App\Constants\Db\DbTableName;

/**
 * 定数: アカウントのプロフィール画像設定
 */
class DbTableAccountNotification extends DbTableCommon {
    /** アカウントのプロフィール画像設定: DB名 */
    const DB_NAME = DbName::ACCOUNT;
    /** アカウントのプロフィール画像設定: テーブル名 */
    const TABLE_NAME = DbTableName::ACCOUNT_PROFILE_IMAGE;

    /** アカウントのプロフィール画像設定: 対象のアカウント基本ID */
    const ACCOUNT_ID = 'account_id';
    /** アカウントのプロフィール画像設定: プロフィール画像のURL */
    const IMAGE_URL = 'image_url';
    /** アカウントのプロフィール画像設定: 現在使用されているプロフィール画像か */
    const SELECTED = 'selected';
}

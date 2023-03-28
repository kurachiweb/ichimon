<?php

declare(strict_types=1);

namespace App\Constants\Db;

/**
 * 定数: セッション情報保存テーブルの共通カラム名
 */
class DbTableSessionCommon {
    /** ID文字列の長さ */
    const KEY_LENGTH = DbTableCommon::KEY_LENGTH;

    const ID = 'id';
    const CREATED_AT = 'created_at';
}

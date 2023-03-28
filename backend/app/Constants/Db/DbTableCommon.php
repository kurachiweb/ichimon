<?php

declare(strict_types=1);

namespace App\Constants\Db;

/**
 * 定数: テーブルの共通カラム名
 */
class DbTableCommon {
    /** ID文字列の長さ */
    const KEY_LENGTH = 31;

    const ID = 'id';
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    const DELETED_AT = 'deleted_at';
}

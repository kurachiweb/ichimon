<?php

declare(strict_types=1);

namespace App\Constants\Db;

/**
 * 定数: ログ情報保存テーブルの共通カラム名
 */
class DbTableLogCommon {
    /** ID文字列の長さ */
    const KEY_LENGTH = DbTableCommon::KEY_LENGTH;

    const ID = 'id';
    const CREATED_AT = 'created_at';
}

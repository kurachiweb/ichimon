<?php

declare(strict_types=1);

namespace App\Constants\Db;

/**
 * 定数: トークン情報保存テーブルの共通カラム名
 */
class DbTableTokenCommon {
    /** ID文字列の長さ */
    const KEY_LENGTH = DbTableCommon::KEY_LENGTH;
    /** トークン文字列の長さ */
    const TOKEN_LENGTH = 63;

    const ID = 'id';
    const TOKEN = 'token';
    const CREATED_AT = 'created_at';
}

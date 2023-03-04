<?php

declare(strict_types=1);

namespace App\Constants\Db;

/**
 * 定数: DB名
 */
class DbName {
  const ACCOUNT = 'ichimon_account';
  const SURVEY = 'ichimon_survey';
  const TOKEN = 'ichimon_reference';
  const REFERENCE = 'ichimon_token';
  const LOG = 'ichimon_log';
}

/**
 * 定数: DBテーブル名
 */
class DbTableName {
  const ACCOUNT = 'account';
  const ACCOUNT_AUTH = 'account_auth';
  const ACCOUNT_LOGIN_SESSION = 'account_login_session';
  const ACCOUNT_NOTIFICATION = 'account_notification';
  const ACCOUNT_PROFILE_IMAGE = 'account_profile_image';
  const ACCOUNT_PUBLISH_URL = 'account_manage_site';
  const ACCOUNT_STYLING = 'account_styling';

  const SURVEY = 'survey';
  const SURVEY_ANSWER = 'survey_answer';
  const SURVEY_PUBLISH = 'survey_publish';
  const SURVEY_QUESTION = 'survey_question';
  const QUESTION_CHOICE = 'question_choice';

  const TOKEN_CHANGE_EMAIL = 'token_change_email';
  const TOKEN_CHANGE_PASSWORD = 'token_change_password';
  const TOKEN_DELETE_ACCOUNT = 'token_delete_account';

  const REFERENCE_LANGUAGE = 'language';
  const REFERENCE_TIMEZONE = 'timezone';

  const LOG_ACCOUNT_SECURITY = 'account_security';
}

/**
 * 定数: 共通カラム名
 */
class DbTableCommon {
  const ID = 'id';
  const CREATED_AT = 'created_at';
  const UPDATED_AT = 'updated_at';
  const DELETED_AT = 'deleted_at';
}

/**
 * 定数: トークン情報保存テーブルの共通カラム名
 */
class DbTableTokenCommon {
  const TOKEN = 'token';
  const CREATED_AT = 'created_at';
}

/**
 * 定数: セッション情報保存テーブルの共通カラム名
 */
class DbTableSessionCommon {
  const ID = 'id';
  const CREATED_AT = 'created_at';
  const DELETED_AT = 'deleted_at';
}

/**
 * 定数: ログ情報保存テーブルの共通カラム名
 */
class DbTableLogCommon {
  const ID = 'id';
  const CREATED_AT = 'created_at';
}

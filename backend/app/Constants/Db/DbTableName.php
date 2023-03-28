<?php

declare(strict_types=1);

namespace App\Constants\Db;

/**
 * 定数: DBテーブル名
 */
class DbTableName {
    const ACCOUNT = 'account';
    const ACCOUNT_AUTH = 'account_auth';
    const ACCOUNT_LOGIN_SESSION = 'account_login_session';
    const ACCOUNT_MANAGE_SITE = 'account_manage_site';
    const ACCOUNT_NOTIFICATION = 'account_notification';
    const ACCOUNT_PROFILE_IMAGE = 'account_profile_image';
    const ACCOUNT_STYLING = 'account_styling';

    const SURVEY = 'survey';
    const SURVEY_PUBLISH = 'survey_publish';
    const SURVEY_QUESTION = 'survey_question';
    const SURVEY_QUESTION_ANSWER = 'question_answer';
    const SURVEY_QUESTION_CHOICE = 'question_choice';

    const TOKEN_CHANGE_EMAIL = 'token_change_email';
    const TOKEN_CHANGE_PASSWORD = 'token_change_password';
    const TOKEN_DELETE_ACCOUNT = 'token_delete_account';

    const REFERENCE_LANGUAGE = 'language';
    const REFERENCE_TIMEZONE = 'timezone';

    const LOG_ACCOUNT_SECURITY = 'account_security';
}

-- MySQL Script generated by MySQL Workbench
-- Sun Mar 12 13:38:40 2023
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema ichimon_account
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema ichimon_account
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `ichimon_account` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin ;
-- -----------------------------------------------------
-- Schema ichimon_survey
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema ichimon_survey
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `ichimon_survey` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin ;
-- -----------------------------------------------------
-- Schema ichimon_token
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema ichimon_token
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `ichimon_token` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin ;
-- -----------------------------------------------------
-- Schema ichimon_reference
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema ichimon_reference
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `ichimon_reference` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin ;
-- -----------------------------------------------------
-- Schema ichimon_log
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema ichimon_log
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `ichimon_log` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin ;
USE `ichimon_account` ;

-- -----------------------------------------------------
-- Table `ichimon_account`.`account`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ichimon_account`.`account` ;

CREATE TABLE IF NOT EXISTS `ichimon_account`.`account` (
  `id` VARCHAR(31) NOT NULL COMMENT 'アカウント基本ID',
  `nickname` VARCHAR(210) NOT NULL COMMENT '表示用ニックネーム',
  `self_intro` VARCHAR(2046) NOT NULL COMMENT '自己紹介',
  `registered_at` DATETIME NOT NULL COMMENT 'アカウント登録完了日時',
  `created_at` DATETIME NOT NULL COMMENT 'データ作成日時',
  `updated_at` DATETIME NOT NULL COMMENT 'データ更新日時',
  `deleted_at` DATETIME NULL DEFAULT NULL COMMENT 'データ削除日時',
  PRIMARY KEY (`id`),
  INDEX `account_nickname_idx` (`nickname` ASC) VISIBLE)
ENGINE = InnoDB
COMMENT = 'アカウント基本情報';


-- -----------------------------------------------------
-- Table `ichimon_account`.`account_manage_site`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ichimon_account`.`account_manage_site` ;

CREATE TABLE IF NOT EXISTS `ichimon_account`.`account_manage_site` (
  `id` VARCHAR(31) NOT NULL COMMENT '公開先サイトID',
  `account_id` VARCHAR(31) NOT NULL COMMENT '対象のアカウント基本ID',
  `title` VARCHAR(63) NOT NULL COMMENT '公開先サイトのタイトル',
  `url` VARCHAR(1022) NOT NULL COMMENT '公開先サイトのURL',
  `sort_priority` INT UNSIGNED NOT NULL COMMENT 'ソート順位',
  `created_at` DATETIME NOT NULL COMMENT 'データ作成日時',
  `updated_at` DATETIME NOT NULL COMMENT 'データ更新日時',
  `deleted_at` DATETIME NULL DEFAULT NULL COMMENT 'データ削除日時',
  PRIMARY KEY (`id`),
  INDEX `fk_account_manage_site_account_idx` (`account_id` ASC) VISIBLE,
  CONSTRAINT `fk_account_manage_site_account`
    FOREIGN KEY (`account_id`)
    REFERENCES `ichimon_account`.`account` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'アカウントの持ち主が管理する、アンケートの公開先サイト情報';


-- -----------------------------------------------------
-- Table `ichimon_account`.`account_styling`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ichimon_account`.`account_styling` ;

CREATE TABLE IF NOT EXISTS `ichimon_account`.`account_styling` (
  `id` VARCHAR(31) NOT NULL COMMENT 'アカウントスタイル設定ID',
  `account_id` VARCHAR(31) NOT NULL COMMENT '対象のアカウント基本ID',
  `font_size` INT UNSIGNED NOT NULL COMMENT 'フォントの大きさ\\npx値の等倍',
  `header_size` SMALLINT UNSIGNED NOT NULL COMMENT 'ヘッダーの大きさ\\n1: 小さい\\n2: デフォルト',
  `language_id` INT UNSIGNED NOT NULL COMMENT '表示言語',
  `timezone_id` INT UNSIGNED NOT NULL COMMENT '時刻表示におけるタイムゾーン',
  `created_at` DATETIME NOT NULL COMMENT 'データ作成日時',
  `updated_at` DATETIME NOT NULL COMMENT 'データ更新日時',
  `deleted_at` DATETIME NULL DEFAULT NULL COMMENT 'データ削除日時',
  PRIMARY KEY (`id`),
  INDEX `fk_account_style_account_idx` (`account_id` ASC) VISIBLE,
  CONSTRAINT `fk_account_style_account`
    FOREIGN KEY (`account_id`)
    REFERENCES `ichimon_account`.`account` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'アカウントごとに管理する、表示設定\\nフォントサイズ設定など。';


-- -----------------------------------------------------
-- Table `ichimon_account`.`account_notification`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ichimon_account`.`account_notification` ;

CREATE TABLE IF NOT EXISTS `ichimon_account`.`account_notification` (
  `id` VARCHAR(31) NOT NULL COMMENT 'アカウント通知設定ID',
  `account_id` VARCHAR(31) NOT NULL COMMENT '対象のアカウント基本ID',
  `way` SMALLINT UNSIGNED NOT NULL COMMENT '通知手段\\nサービス内通知やメール通知',
  `trigger` SMALLINT UNSIGNED NOT NULL COMMENT '通知トリガーの発生タイミング',
  `enabled` SMALLINT UNSIGNED NOT NULL COMMENT 'その通知トリガーは有効か',
  `created_at` DATETIME NOT NULL COMMENT 'データ作成日時',
  `updated_at` DATETIME NOT NULL COMMENT 'データ更新日時',
  `deleted_at` DATETIME NULL DEFAULT NULL COMMENT 'データ削除日時',
  PRIMARY KEY (`id`),
  INDEX `fk_account_setting_notification_account_idx` (`account_id` ASC) VISIBLE,
  CONSTRAINT `fk_account_setting_notification_account`
    FOREIGN KEY (`account_id`)
    REFERENCES `ichimon_account`.`account` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'アカウントの通知設定';


-- -----------------------------------------------------
-- Table `ichimon_account`.`account_profile_image`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ichimon_account`.`account_profile_image` ;

CREATE TABLE IF NOT EXISTS `ichimon_account`.`account_profile_image` (
  `id` VARCHAR(31) NOT NULL COMMENT 'アカウントプロフィール画像設定ID',
  `account_id` VARCHAR(31) NOT NULL,
  `image_url` VARCHAR(255) NOT NULL COMMENT 'プロフィール画像のURL',
  `selected` SMALLINT UNSIGNED NOT NULL COMMENT '現在使用されているプロフィール画像か',
  `created_at` DATETIME NOT NULL COMMENT 'データ作成日時',
  `updated_at` DATETIME NOT NULL COMMENT 'データ更新日時',
  `deleted_at` DATETIME NULL DEFAULT NULL COMMENT 'データ削除日時',
  PRIMARY KEY (`id`),
  INDEX `fk_account_profile_image_account_idx` (`account_id` ASC) VISIBLE,
  CONSTRAINT `fk_account_profile_image_account`
    FOREIGN KEY (`account_id`)
    REFERENCES `ichimon_account`.`account` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'アカウントのプロフィール画像設定';


-- -----------------------------------------------------
-- Table `ichimon_account`.`account_login_session`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ichimon_account`.`account_login_session` ;

CREATE TABLE IF NOT EXISTS `ichimon_account`.`account_login_session` (
  `id` VARCHAR(31) NOT NULL COMMENT 'アカウントログイン保持情報ID',
  `account_id` VARCHAR(31) NOT NULL COMMENT '対象のアカウント基本ID',
  `token_hash` VARCHAR(510) NOT NULL COMMENT 'トークンのハッシュ文字列',
  `ip_address` VARCHAR(255) NULL DEFAULT NULL COMMENT 'IPアドレスの暗号化文字列',
  `user_agent` TEXT NULL DEFAULT NULL COMMENT 'ユーザーエージェントの暗号化文字列',
  `last_login_at` DATETIME NOT NULL COMMENT '最終ログイン日時',
  `created_at` DATETIME NOT NULL COMMENT 'データ作成日時',
  `updated_at` DATETIME NOT NULL COMMENT 'データ更新日時',
  PRIMARY KEY (`id`),
  INDEX `fk_ account_login_session_account_idx` (`account_id` ASC) VISIBLE,
  CONSTRAINT `fk_ account_login_session_account`
    FOREIGN KEY (`account_id`)
    REFERENCES `ichimon_account`.`account` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'アカウントログイン保持情報';


-- -----------------------------------------------------
-- Table `ichimon_account`.`account_auth`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ichimon_account`.`account_auth` ;

CREATE TABLE IF NOT EXISTS `ichimon_account`.`account_auth` (
  `id` VARCHAR(31) NOT NULL COMMENT 'アカウントログイン保持情報ID',
  `account_id` VARCHAR(31) NOT NULL,
  `email` VARCHAR(628) NOT NULL COMMENT 'メールアドレスの暗号化済み文字列',
  `email_hash` VARCHAR(128) NOT NULL COMMENT 'メールアドレスのハッシュ文字列\nメールアドレスが他のアカウントで使われているかの判定用',
  `verified_email` SMALLINT UNSIGNED NOT NULL COMMENT 'メールアドレスの認証状態\n0:未認証 1:認証手続き中 2:認証済',
  `password` VARCHAR(1026) NOT NULL COMMENT 'メールアドレスの暗号化済み文字列',
  `password_updated_at` DATETIME NOT NULL COMMENT 'パスワードの最終更新日時',
  `created_at` DATETIME NOT NULL COMMENT 'データ作成日時',
  `updated_at` DATETIME NOT NULL COMMENT 'データ更新日時',
  `deleted_at` DATETIME NULL DEFAULT NULL COMMENT 'データ削除日時',
  PRIMARY KEY (`id`),
  INDEX `fk_account_auth_account_idx` (`account_id` ASC) VISIBLE,
  CONSTRAINT `fk_account_auth_account`
    FOREIGN KEY (`account_id`)
    REFERENCES `ichimon_account`.`account` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'アカウントログイン保持情報';

USE `ichimon_survey` ;

-- -----------------------------------------------------
-- Table `ichimon_survey`.`survey`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ichimon_survey`.`survey` ;

CREATE TABLE IF NOT EXISTS `ichimon_survey`.`survey` (
  `id` VARCHAR(31) NOT NULL COMMENT 'アンケートID',
  `account_id` VARCHAR(31) NOT NULL COMMENT '対象のアカウント基本ID',
  `title` VARCHAR(255) NOT NULL COMMENT '作成者向けのタイトル',
  `greeting` VARCHAR(255) NOT NULL COMMENT '回答者向けのつかみメッセージ',
  `description` VARCHAR(2046) NOT NULL COMMENT '回答者向けの説明',
  `publish_start_at` DATETIME NOT NULL COMMENT 'アンケート公開開始日時',
  `publish_end_at` DATETIME NOT NULL COMMENT 'アンケート公開終了日時',
  `created_at` DATETIME NOT NULL COMMENT 'データ作成日時',
  `updated_at` DATETIME NOT NULL COMMENT 'データ更新日時',
  `deleted_at` DATETIME NULL DEFAULT NULL COMMENT 'データ削除日時',
  PRIMARY KEY (`id`),
  INDEX `fk_survey_account_idx` (`account_id` ASC) VISIBLE,
  CONSTRAINT `fk_survey_account`
    FOREIGN KEY (`account_id`)
    REFERENCES `ichimon_account`.`account` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'アンケート\\nタイトルや質問項目などから成る';


-- -----------------------------------------------------
-- Table `ichimon_survey`.`survey_question`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ichimon_survey`.`survey_question` ;

CREATE TABLE IF NOT EXISTS `ichimon_survey`.`survey_question` (
  `id` VARCHAR(31) NOT NULL COMMENT '質問ID',
  `survey_id` VARCHAR(31) NOT NULL COMMENT '対象のアンケートID',
  `type` SMALLINT UNSIGNED NOT NULL COMMENT '質問の種類\\n1:1行テキスト\\n2:複数行テキスト\\n3:チェックボックス\\n4:ラジオボタン\\n5:プルダウン形式選択',
  `description` VARCHAR(2046) NULL DEFAULT NULL COMMENT '質問文',
  `created_at` DATETIME NOT NULL COMMENT 'データ作成日時',
  `updated_at` DATETIME NOT NULL COMMENT 'データ更新日時',
  `deleted_at` DATETIME NULL DEFAULT NULL COMMENT 'データ削除日時',
  PRIMARY KEY (`id`),
  INDEX `fk_question_survey_idx` (`survey_id` ASC) VISIBLE,
  CONSTRAINT `fk_question_survey`
    FOREIGN KEY (`survey_id`)
    REFERENCES `ichimon_survey`.`survey` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'アンケートの質問項目';


-- -----------------------------------------------------
-- Table `ichimon_survey`.`question_choice`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ichimon_survey`.`question_choice` ;

CREATE TABLE IF NOT EXISTS `ichimon_survey`.`question_choice` (
  `id` VARCHAR(31) NOT NULL COMMENT '回答選択肢ID\\n1以上のランダム値\\n不変',
  `question_id` VARCHAR(31) NOT NULL COMMENT '対象の質問ID',
  `name` VARCHAR(255) NOT NULL COMMENT '選択肢名',
  `created_at` DATETIME NOT NULL COMMENT 'データ作成日時',
  `updated_at` DATETIME NOT NULL COMMENT 'データ更新日時',
  `deleted_at` DATETIME NULL DEFAULT NULL COMMENT 'データ削除日時',
  PRIMARY KEY (`id`),
  INDEX `fk_question_choice_question_idx` (`question_id` ASC) VISIBLE,
  CONSTRAINT `fk_question_choice_question`
    FOREIGN KEY (`question_id`)
    REFERENCES `ichimon_survey`.`survey_question` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = '回答選択肢';


-- -----------------------------------------------------
-- Table `ichimon_survey`.`question_answer`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ichimon_survey`.`question_answer` ;

CREATE TABLE IF NOT EXISTS `ichimon_survey`.`question_answer` (
  `id` VARCHAR(31) NOT NULL COMMENT 'アンケートへの回答ID',
  `question_id` VARCHAR(31) NOT NULL COMMENT '対象の質問ID',
  `question_choice_id` VARCHAR(31) NULL DEFAULT NULL COMMENT '選んだ選択肢\\n自由入力型ではNULL',
  `text` TEXT NULL DEFAULT NULL COMMENT '回答における記述内容\\n選択式ではNULL',
  `created_at` DATETIME NOT NULL COMMENT 'データ作成日時',
  `updated_at` DATETIME NOT NULL COMMENT 'データ更新日時',
  `deleted_at` DATETIME NULL DEFAULT NULL COMMENT 'データ削除日時',
  PRIMARY KEY (`id`),
  INDEX `fk_answer_question_idx` (`question_id` ASC) VISIBLE,
  CONSTRAINT `fk_answer_question`
    FOREIGN KEY (`question_id`)
    REFERENCES `ichimon_survey`.`survey_question` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'アンケートへの回答';


-- -----------------------------------------------------
-- Table `ichimon_survey`.`survey_publish`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ichimon_survey`.`survey_publish` ;

CREATE TABLE IF NOT EXISTS `ichimon_survey`.`survey_publish` (
  `id` VARCHAR(31) NOT NULL,
  `survey_id` VARCHAR(31) NOT NULL COMMENT '対象のアンケートID',
  `account_url_id` VARCHAR(31) NOT NULL COMMENT 'アンケートの公開対象URL',
  `created_at` DATETIME NOT NULL COMMENT 'データ作成日時',
  `updated_at` DATETIME NOT NULL COMMENT 'データ更新日時',
  `deleted_at` DATETIME NULL DEFAULT NULL COMMENT 'データ削除日時',
  PRIMARY KEY (`id`),
  INDEX `fk_survey_publish_survey_idx` (`survey_id` ASC) VISIBLE,
  CONSTRAINT `fk_survey_publish_survey`
    FOREIGN KEY (`survey_id`)
    REFERENCES `ichimon_survey`.`survey` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'アンケートを公開する対象URL';

USE `ichimon_token` ;

-- -----------------------------------------------------
-- Table `ichimon_token`.`token_change_email`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ichimon_token`.`token_change_email` ;

CREATE TABLE IF NOT EXISTS `ichimon_token`.`token_change_email` (
  `id` VARCHAR(31) NOT NULL COMMENT '識別ID',
  `account_id` VARCHAR(31) NOT NULL COMMENT '認証対象のアカウント基本ID',
  `token` VARCHAR(768) NOT NULL COMMENT 'メールアドレス変更リクエストの際に発行されたトークン',
  `created_at` DATETIME NOT NULL COMMENT 'データ作成日時',
  PRIMARY KEY (`id`),
  INDEX `fk_token_change_email_account_idx` (`account_id` ASC) VISIBLE,
  CONSTRAINT `fk_token_change_email_account`
    FOREIGN KEY (`account_id`)
    REFERENCES `ichimon_account`.`account` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'アカウントのメールアドレス変更リクエストが正当であるかを検証する、照合トークンリスト。';


-- -----------------------------------------------------
-- Table `ichimon_token`.`token_change_password`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ichimon_token`.`token_change_password` ;

CREATE TABLE IF NOT EXISTS `ichimon_token`.`token_change_password` (
  `id` VARCHAR(31) NOT NULL COMMENT '識別ID',
  `account_id` VARCHAR(31) NOT NULL COMMENT '認証対象のアカウント基本ID',
  `token` VARCHAR(768) NOT NULL COMMENT 'パスワード変更リクエストの際に発行されたトークン',
  `created_at` DATETIME NOT NULL COMMENT 'データ作成日時',
  PRIMARY KEY (`id`),
  INDEX `fk_change_password_token_account_idx` (`account_id` ASC) VISIBLE,
  CONSTRAINT `fk_change_password_token_account`
    FOREIGN KEY (`account_id`)
    REFERENCES `ichimon_account`.`account` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'アカウントのパスワード変更リクエストが正当であるかを検証する、照合トークンリスト。';


-- -----------------------------------------------------
-- Table `ichimon_token`.`token_delete_account`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ichimon_token`.`token_delete_account` ;

CREATE TABLE IF NOT EXISTS `ichimon_token`.`token_delete_account` (
  `id` VARCHAR(31) NOT NULL COMMENT '識別ID',
  `account_id` VARCHAR(31) NOT NULL COMMENT '認証対象のアカウント基本ID',
  `token` VARCHAR(768) NOT NULL COMMENT 'アカウント削除リクエストの際に発行されたトークン',
  `created_at` DATETIME NOT NULL COMMENT 'データ作成日時',
  PRIMARY KEY (`id`),
  INDEX `fk_delete_account_token_account_idx` (`account_id` ASC) VISIBLE,
  CONSTRAINT `fk_token_delete_account_account`
    FOREIGN KEY (`account_id`)
    REFERENCES `ichimon_account`.`account` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'アカウントの削除リクエストが正当であるかを検証する、照合トークンリスト。';

USE `ichimon_reference` ;

-- -----------------------------------------------------
-- Table `ichimon_reference`.`language`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ichimon_reference`.`language` ;

CREATE TABLE IF NOT EXISTS `ichimon_reference`.`language` (
  `id` INT UNSIGNED NOT NULL COMMENT '表示言語ID',
  `name` VARCHAR(31) NOT NULL COMMENT 'RFC 5646に基づく言語タグ',
  `localized_name` VARCHAR(63) NOT NULL COMMENT '各言語に合わせた言語名表記',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
COMMENT = '表示言語参照情報';


-- -----------------------------------------------------
-- Table `ichimon_reference`.`timezone`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ichimon_reference`.`timezone` ;

CREATE TABLE IF NOT EXISTS `ichimon_reference`.`timezone` (
  `id` INT UNSIGNED NOT NULL COMMENT '表示タイムゾーンID',
  `name` VARCHAR(31) NOT NULL COMMENT 'IANA Time Zone Databaseに基づく表記',
  `area` VARCHAR(63) NOT NULL COMMENT 'そのタイムゾーンに該当する国や地域',
  `utc_offset` INT NOT NULL COMMENT '協定世界時との差(分単位)',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
COMMENT = 'タイムゾーン参照情報';

USE `ichimon_log` ;

-- -----------------------------------------------------
-- Table `ichimon_log`.`account_security`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ichimon_log`.`account_security` ;

CREATE TABLE IF NOT EXISTS `ichimon_log`.`account_security` (
  `id` VARCHAR(31) NOT NULL COMMENT 'アカウントセキュリティログID',
  `account_id` VARCHAR(31) NOT NULL COMMENT '対象のアカウント情報ID',
  `type` SMALLINT UNSIGNED NOT NULL COMMENT 'アカウントセキュリティログの種類\\n1:新規登録 2: アカウント削除 11: ログイン 12:他のセッションからログアウト 21:メールアドレスを認証 22:メールアドレスの変更 23:パスワードの変更',
  `created_at` DATETIME NOT NULL COMMENT 'データ作成日時',
  PRIMARY KEY (`id`),
  INDEX `fk_account_security_account_idx` (`account_id` ASC) VISIBLE,
  CONSTRAINT `fk_account_security_account`
    FOREIGN KEY (`account_id`)
    REFERENCES `ichimon_account`.`account` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'アカウントのセキュリティログ\\nログインやパスワード変更など';


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

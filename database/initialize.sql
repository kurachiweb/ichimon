-- MySQL Script generated by MySQL Workbench
-- Thu May  5 11:39:16 2022
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema kurachiweb_ichimondev
-- -----------------------------------------------------
-- 1問の開発用DB

-- -----------------------------------------------------
-- Schema kurachiweb_ichimondev
--
-- 1問の開発用DB
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `kurachiweb_ichimondev` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_bin ;
USE `kurachiweb_ichimondev` ;

-- -----------------------------------------------------
-- Table `kurachiweb_ichimondev`.`account`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `kurachiweb_ichimondev`.`account` ;

CREATE TABLE IF NOT EXISTS `kurachiweb_ichimondev`.`account` (
  `id` BIGINT UNSIGNED NOT NULL COMMENT 'アカウント基本情報ID\n1以上のランダム値\n不変',
  `display_id` VARCHAR(32) NOT NULL COMMENT '表示用アカウントID\n値は変更可能',
  `name` VARCHAR(510) NOT NULL COMMENT 'アカウント名',
  `registered_at` DATETIME NOT NULL COMMENT '会員登録日時',
  `tel_no` VARCHAR(510) NULL DEFAULT NULL COMMENT '自宅/勤務先電話番号の暗号化済み文字列',
  `mobile_no` VARCHAR(510) NULL DEFAULT NULL COMMENT '携帯電話番号の暗号化済み文字列',
  `address` VARCHAR(2046) NULL DEFAULT NULL COMMENT '住所',
  `address_bill` VARCHAR(2046) NULL DEFAULT NULL COMMENT '請求先住所',
  `created_at` DATETIME NOT NULL COMMENT 'データ作成日時',
  `updated_at` DATETIME NOT NULL COMMENT 'データ更新日時',
  `deleted_at` DATETIME NULL DEFAULT NULL COMMENT 'データ削除日時',
  PRIMARY KEY (`id`),
  UNIQUE INDEX `display_id_UNIQUE` (`display_id` ASC))
ENGINE = InnoDB
COMMENT = 'アカウント基本情報';


-- -----------------------------------------------------
-- Table `kurachiweb_ichimondev`.`survey_category`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `kurachiweb_ichimondev`.`survey_category` ;

CREATE TABLE IF NOT EXISTS `kurachiweb_ichimondev`.`survey_category` (
  `id` BIGINT UNSIGNED NOT NULL COMMENT 'カテゴリID\n1以上のランダム値\n不変',
  `creator_id` BIGINT UNSIGNED NOT NULL COMMENT 'カテゴリを設定したアカウントの基本情報D',
  `name` VARCHAR(127) NOT NULL COMMENT 'カテゴリ名',
  `sort_no` INT UNSIGNED NOT NULL COMMENT 'ソート番号',
  `created_at` DATETIME NOT NULL COMMENT 'データ作成日時',
  `updated_at` DATETIME NOT NULL COMMENT 'データ更新日時',
  `deleted_at` DATETIME NULL DEFAULT NULL COMMENT 'データ削除日時',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
COMMENT = 'カテゴリ';


-- -----------------------------------------------------
-- Table `kurachiweb_ichimondev`.`survey`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `kurachiweb_ichimondev`.`survey` ;

CREATE TABLE IF NOT EXISTS `kurachiweb_ichimondev`.`survey` (
  `id` BIGINT UNSIGNED NOT NULL COMMENT 'アンケートID\n1以上のランダム値\n不変',
  `title` VARCHAR(255) NULL DEFAULT NULL COMMENT 'タイトル',
  `description_before` VARCHAR(2046) NULL DEFAULT NULL COMMENT '説明',
  `category_id` BIGINT UNSIGNED NOT NULL COMMENT 'カテゴリーID',
  `notice_after` VARCHAR(2046) NULL DEFAULT NULL COMMENT '設問後の補足文章',
  `creator_id` BIGINT UNSIGNED NOT NULL COMMENT 'アンケートを作成したアカウントの基本情報ID',
  `notice_account_id` BIGINT UNSIGNED NOT NULL COMMENT 'アンケートに関して通知するアカウントの基本情報ID',
  `created_at` DATETIME NOT NULL COMMENT 'データ作成日時',
  `updated_at` DATETIME NOT NULL COMMENT 'データ更新日時',
  `deleted_at` DATETIME NULL DEFAULT NULL COMMENT 'データ削除日時',
  PRIMARY KEY (`id`, `category_id`),
  INDEX `fk_survey_category_idx` (`category_id` ASC),
  CONSTRAINT `fk_survey_category`
    FOREIGN KEY (`category_id`)
    REFERENCES `kurachiweb_ichimondev`.`survey_category` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'アンケート\nタイトルや質問項目などから成る';


-- -----------------------------------------------------
-- Table `kurachiweb_ichimondev`.`question`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `kurachiweb_ichimondev`.`question` ;

CREATE TABLE IF NOT EXISTS `kurachiweb_ichimondev`.`question` (
  `id` BIGINT UNSIGNED NOT NULL COMMENT '質問ID\n1以上のランダム値\n不変',
  `survey_id` BIGINT UNSIGNED NOT NULL COMMENT 'アンケートID',
  `type` TINYINT UNSIGNED NOT NULL COMMENT '質問の種類\n1:1行テキスト\n2:複数行テキスト\n3:チェックボックス\n4:ラジオボタン\n5:プルダウン形式選択',
  `description` VARCHAR(2046) NULL DEFAULT NULL COMMENT '質問文',
  `created_at` DATETIME NOT NULL COMMENT 'データ作成日時',
  `updated_at` DATETIME NOT NULL COMMENT 'データ更新日時',
  `deleted_at` DATETIME NULL DEFAULT NULL COMMENT 'データ削除日時',
  PRIMARY KEY (`id`),
  INDEX `type` (`type` ASC),
  INDEX `fk_question_survey_idx` (`survey_id` ASC),
  CONSTRAINT `fk_question_survey`
    FOREIGN KEY (`survey_id`)
    REFERENCES `kurachiweb_ichimondev`.`survey` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'アンケートの質問項目';


-- -----------------------------------------------------
-- Table `kurachiweb_ichimondev`.`question_choice`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `kurachiweb_ichimondev`.`question_choice` ;

CREATE TABLE IF NOT EXISTS `kurachiweb_ichimondev`.`question_choice` (
  `id` BIGINT UNSIGNED NOT NULL COMMENT '回答選択肢ID\n1以上のランダム値\n不変',
  `question_id` BIGINT UNSIGNED NOT NULL,
  `label` VARCHAR(255) NOT NULL COMMENT 'フロント用選択肢ラベル',
  `value` INT UNSIGNED NOT NULL COMMENT 'フロント用選択肢ID',
  `created_at` DATETIME NOT NULL COMMENT 'データ作成日時',
  `updated_at` DATETIME NOT NULL COMMENT 'データ更新日時',
  `deleted_at` DATETIME NULL DEFAULT NULL COMMENT 'データ削除日時',
  PRIMARY KEY (`id`),
  INDEX `fk_question_choice_question_idx` (`question_id` ASC),
  CONSTRAINT `fk_question_choice_question`
    FOREIGN KEY (`question_id`)
    REFERENCES `kurachiweb_ichimondev`.`question` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = '質問に対する回答項目';


-- -----------------------------------------------------
-- Table `kurachiweb_ichimondev`.`answer`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `kurachiweb_ichimondev`.`answer` ;

CREATE TABLE IF NOT EXISTS `kurachiweb_ichimondev`.`answer` (
  `id` BIGINT UNSIGNED NOT NULL COMMENT 'アンケートへの回答ID',
  `question_id` BIGINT UNSIGNED NOT NULL COMMENT '質問ID',
  `choice_value` INT UNSIGNED NULL DEFAULT NULL COMMENT '選んだ選択肢\n自由入力型ではNULL',
  `text` VARCHAR(16000) NULL DEFAULT NULL COMMENT '回答における記述内容\n選択式ではNULL',
  `created_at` DATETIME NOT NULL COMMENT 'データ作成日時',
  `updated_at` DATETIME NOT NULL COMMENT 'データ更新日時',
  `deleted_at` DATETIME NULL DEFAULT NULL COMMENT 'データ削除日時',
  PRIMARY KEY (`id`),
  INDEX `fk_answer_question_idx` (`question_id` ASC),
  CONSTRAINT `fk_answer_question`
    FOREIGN KEY (`question_id`)
    REFERENCES `kurachiweb_ichimondev`.`question` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
COMMENT = 'アンケートへの回答';


-- -----------------------------------------------------
-- Table `kurachiweb_ichimondev`.`question_type`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `kurachiweb_ichimondev`.`question_type` ;

CREATE TABLE IF NOT EXISTS `kurachiweb_ichimondev`.`question_type` (
  `id` INT NOT NULL COMMENT '回答形式ID',
  `name` VARCHAR(31) NOT NULL COMMENT '回答形式名',
  `sort_id` INT UNSIGNED NOT NULL COMMENT 'ソート順位',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
COMMENT = '回答形式リファレンス';


-- -----------------------------------------------------
-- Table `kurachiweb_ichimondev`.`prefecture`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `kurachiweb_ichimondev`.`prefecture` ;

CREATE TABLE IF NOT EXISTS `kurachiweb_ichimondev`.`prefecture` (
  `id` INT NOT NULL COMMENT '都道府県ID',
  `name` VARCHAR(7) NOT NULL COMMENT '都道府県名',
  PRIMARY KEY (`id`))
ENGINE = InnoDB
COMMENT = '都道府県リファレンス';


-- -----------------------------------------------------
-- Table `kurachiweb_ichimondev`.`answer_token`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `kurachiweb_ichimondev`.`answer_token` ;

CREATE TABLE IF NOT EXISTS `kurachiweb_ichimondev`.`answer_token` (
  `token` VARCHAR(3072) NOT NULL COMMENT 'アンケート表示リクエストの際に発行されたトークン',
  `created_at` DATETIME NOT NULL COMMENT 'データ作成日時',
  `updated_at` DATETIME NOT NULL COMMENT 'データ更新日時',
  `deleted_at` DATETIME NULL DEFAULT NULL COMMENT 'データ削除日時',
  PRIMARY KEY (`token`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = ascii
COLLATE = ascii_bin
COMMENT = 'アンケートへの回答リクエストが正当であるかを検証する、照合トークンリスト。';


-- -----------------------------------------------------
-- Table `kurachiweb_ichimondev`.`account_auth`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `kurachiweb_ichimondev`.`account_auth` ;

CREATE TABLE IF NOT EXISTS `kurachiweb_ichimondev`.`account_auth` (
  `id` BIGINT UNSIGNED NOT NULL COMMENT 'アカウント認証情報ID\n1以上のランダム値\n不変',
  `account_id` BIGINT UNSIGNED NOT NULL,
  `email` VARCHAR(1026) NOT NULL COMMENT 'メールアドレスの暗号化済み文字列\n復号して利用できる',
  `email_hash` VARCHAR(128) NOT NULL COMMENT 'メールアドレスのハッシュ文字列\nメールアドレスが他のアカウントで使われているかの判定用',
  `email_alter` VARCHAR(1026) NULL DEFAULT NULL COMMENT 'メールアドレスの暗号化済み文字列\n主とするメールアドレスが使えなくなった場合の連絡用',
  `verified_email` INT UNSIGNED NOT NULL COMMENT 'メールアドレスの存在が確認されたか\n0:未認証 1:認証手続き中 2:認証済',
  `verified_mobile_no` INT UNSIGNED NOT NULL COMMENT '電話番号の存在が確認されたか\n0:未認証 1:認証手続き中 2:認証済',
  `password` VARCHAR(255) NOT NULL COMMENT 'パスワード',
  `password_updated_at` DATETIME NOT NULL COMMENT 'パスワードの最終更新日時',
  `billing_token` VARCHAR(127) NULL COMMENT 'サブスクリプションの管理用トークン\n有料プラン登録済みなら必須',
  `created_at` DATETIME NOT NULL COMMENT 'データ作成日時',
  `updated_at` DATETIME NOT NULL COMMENT 'データ更新日時',
  `deleted_at` DATETIME NULL DEFAULT NULL COMMENT 'データ削除日時',
  PRIMARY KEY (`id`),
  INDEX `fk_account_auth_account_idx` (`account_id` ASC),
  UNIQUE INDEX `email_hash_UNIQUE` (`email_hash` ASC),
  CONSTRAINT `fk_account_auth_account`
    FOREIGN KEY (`account_id`)
    REFERENCES `kurachiweb_ichimondev`.`account` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = ascii
COLLATE = ascii_bin
COMMENT = 'アカウント認証情報';


-- -----------------------------------------------------
-- Table `kurachiweb_ichimondev`.`verify_email_token`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `kurachiweb_ichimondev`.`verify_email_token` ;

CREATE TABLE IF NOT EXISTS `kurachiweb_ichimondev`.`verify_email_token` (
  `token` VARCHAR(3072) NOT NULL COMMENT 'メールアドレス認証リクエストの際に発行されたトークン',
  `created_at` DATETIME NOT NULL COMMENT 'データ作成日時',
  `updated_at` DATETIME NOT NULL COMMENT 'データ更新日時',
  `deleted_at` DATETIME NULL DEFAULT NULL COMMENT 'データ削除日時',
  PRIMARY KEY (`token`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = ascii
COLLATE = ascii_bin
COMMENT = 'アカウントのメールアドレス認証リクエストが正当であるかを検証する、照合トークンリスト。';


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

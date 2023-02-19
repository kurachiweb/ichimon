# apache: Apacheを内蔵する
# bullseye: Debian 11のコードネームであるがXserverのOSとは異なる
# XserverはApacheの設定ファイルに基づいてNginxを動かしている
FROM php:8.1.16-apache-bullseye as base

# 作業ディレクトリを作成する
WORKDIR /usr/src/app

# ComposerやLaravelの実行時に必要な機能のインストール
RUN apt-get update && \
  apt-get -y install \
    locales \
    git \
    unzip \
    libzip-dev \
    libicu-dev && \
  apt-get clean && \
  rm -rf /var/lib/apt/lists/* && \
  docker-php-ext-install pdo_mysql bcmath zip

# composerを取り入れて。マルチステージビルドする
# ディレクトリ等指定部分だけをコピーし、他はビルドに含めないことでイメージのサイズを小さくしている
COPY --from=composer:2.5 /usr/bin/composer /usr/bin/composer

# PHPの設定ファイルを上書きする
# Xserverの設定と同一である
COPY ./docker-assets/php.ini /usr/local/etc/php/

# Apacheの設定ファイルを上書きする
# Debian系なので、ファイル名はhttpd.confではない
COPY ./docker-assets/apache2.conf /etc/apache2/

# アプリケーションの依存関係定義と環境変数のファイルをコピー
COPY composer.json ./
COPY .env ./

# Composerによるインストールを、root権限でもできるようにする
ENV COMPOSER_ALLOW_SUPERUSER 1

# パスの設定
ENV COMPOSER_HOME /usr/src/composer
ENV PATH $PATH:/usr/src/composer/vendor/bin

# 開発環境
FROM base as dev

# インストール後は、ソース全体を利用可能にする
COPY . .

# 本番環境
FROM base as prod

# イメージ作成時に、依存モジュールをインストール
# 開発用パッケージはインストールせず、オートローダーによる最適化を行う
RUN composer install --optimize-autoloader --no-dev

COPY . .

# コンテナ起動時に実行するコマンド
CMD ["php", "artisan", "serve"]

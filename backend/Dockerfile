# apache: Apacheを内蔵する
# bullseye: Debian 11のコードネームであるがXserverのOSとは異なる
# XserverはApacheの設定ファイルに基づいてNginxを動かしている
FROM php:8.0.16-apache-bullseye

# 作業ディレクトリを作成する
WORKDIR /usr/src/app

# ComposerやLaravelの実行時に必要な機能のインストール
RUN apt-get update && \
  apt-get -y install git unzip && \
  apt-get clean && \
  rm -rf /var/lib/apt/lists/*

# composerを取り入れて。マルチステージビルドする
# ディレクトリ等指定部分だけをコピーし、他はビルドに含めないことでイメージのサイズを小さくしている
COPY --from=composer:2.3 /usr/bin/composer /usr/bin/composer

# PHPの設定ファイルを上書きする
# Xserverの設定と同一である
COPY ./docker-assets/php.ini /usr/local/etc/php/php.ini

# アプリケーションの依存関係と環境変数のファイルをコピー
# ワイルドカードを使い、composer.jsonとcomposer.lockの両方を対象にする
# 作業ディレクトリ丸ごとコピーでは、ソースコードを少し変更しただけでもcomposer installが実行されてしまうため
COPY composer.* .env ./

# Composerによるインストールを、root権限でもできるようにする
ENV COMPOSER_ALLOW_SUPERUSER 1

# イメージ作成時に、依存モジュールをインストール
RUN composer install

# インストール後は、ソース全体を利用可能にする
COPY . .

# コンテナ起動時に実行するコマンド
CMD ["php", "artisan", "serve"]

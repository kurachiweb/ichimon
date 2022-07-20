# apache: Apacheを内蔵する
# bullseye: Debian 11のコードネームであるがXserverのOSとは異なる
# XserverはApacheの設定ファイルに基づいてNginxを動かしている
FROM php:8.0.16-apache-bullseye

# composerを取り入れて。マルチステージビルドする
# ディレクトリ等指定部分だけをコピーし、他はビルドに含めないことでイメージのサイズを小さくしている
COPY --from=composer:2.3 /usr/bin/composer /usr/bin/composer

# PHPの設定ファイルを上書きする
# Xserverの設定と同一である
COPY ./docker-assets/php.ini /usr/local/etc/php/php.ini

# 作業ディレクトリを作成する
WORKDIR /usr/src/app

# インストール後は、ソース全体を利用可能にする
COPY . .

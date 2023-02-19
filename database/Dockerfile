# Ubuntu 22.04 LTS版
FROM mariadb:10.11-jammy

# OSのタイムゾーンをUTCにする
# MariaDBのタイムゾーンは、デフォルトでシステム設定を参照するため
ENV TZ=UTC

# 外部に公開したいポートの説明
# docker run -P コマンドにより、ここでEXPOSE指定した全てのポートを公開する、という使い方もできる
EXPOSE 3306

FROM node:18.5.0-alpine3.15

# 作業ディレクトリを作成する
WORKDIR /usr/src/app

# アプリケーションの依存関係をインストールする
# ワイルドカードを使い、package.jsonとpackage-lock.jsonの両方をコピー
# 作業ディレクトリ丸ごとコピーでは、Dockerのキャッシュが効かないため
COPY package*.json ./

# イメージ作成時に、依存モジュールをインストール
# 本番環境なら npm install --only=production
RUN npm install

# インストール後は、ソース全体を利用可能にする
COPY . .

# 外部に公開するポート
# Vue CLIの設定で、ポート9000を指定したため
EXPOSE 80

# コンテナ起動時に実行するコマンド
# 使用イメージのデフォルトCMD設定を上書きする
CMD npm run serve

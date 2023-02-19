# Debian 11(bullseye)であり、使用頻度が低いライブラリを含まない軽量版
FROM node:18.14-bullseye-slim as base

# 作業ディレクトリを作成する
WORKDIR /usr/src/app

# 開発環境
FROM base as dev-builder
ENV NODE_ENV=development

# アプリケーションの依存モジュールをインストール
COPY package*.json ./
RUN npm install

FROM dev-builder as dev

# インストール後は、ソース全体を利用可能にする
COPY . .

# 本番環境
FROM base as prod-builder
ENV NODE_ENV=production

COPY package-lock.json ./
RUN npm ci --only=production

FROM prod-builder as prod

# インストール後は、ソース全体を非root権限で利用可能にする
USER node
COPY --chown=node:node . .

# .nuxtディレクトリに出力し、SSRの用意を整える
CMD ["npm", "run", "build"]

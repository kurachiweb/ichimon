# ichimon

One question survey.
1問だけのアンケートです。

## 開発で使うコマンド

`php artisan config:clear && php artisan cache:clear && php artisan route:clear && php artisan view:clear`

`php artisan db:seed`

`docker compose -f compose.yaml -f compose.m1-mac.yaml up -d --build`

`docker system prune --volumes`

## サービス利用者が設定できる文字数

人の目で見る文字数で測る？

表示用ID : 30文字
英数字・ハイフン・アンダーバーを許容

ニックネーム : 60文字
任意の文字列を許容したいが、ゼロ文字や改行コードはどうする?

本名姓 : 30文字
ミドル : 60文字
本名名 : 30文字
許容しないのは絵文字・ゼロ文字や改行コード

メールアドレス：254文字
RFC準拠が原則だが、2009年以前のdocomoはどうする?

住所広域：40
市：60
町番地：120
建物名：120
許容しないのは絵文字・ゼロ文字や改行コード

## Integrate with your tools

- [ ] [Set up project integrations](https://gitlab.com/kurachiweb/ichimon/-/settings/integrations)

## Collaborate with your team

- [ ] [Invite team members and collaborators](https://docs.gitlab.com/ee/user/project/members/)
- [ ] [Create a new merge request](https://docs.gitlab.com/ee/user/project/merge_requests/creating_merge_requests.html)
- [ ] [Automatically close issues from merge requests](https://docs.gitlab.com/ee/user/project/issues/managing_issues.html#closing-issues-automatically)
- [ ] [Enable merge request approvals](https://docs.gitlab.com/ee/user/project/merge_requests/approvals/)
- [ ] [Automatically merge when pipeline succeeds](https://docs.gitlab.com/ee/user/project/merge_requests/merge_when_pipeline_succeeds.html)

## Test and Deploy

Use the built-in continuous integration in GitLab.

- [ ] [Get started with GitLab CI/CD](https://docs.gitlab.com/ee/ci/quick_start/index.html)
- [ ] [Analyze your code for known vulnerabilities with Static Application Security Testing(SAST)](https://docs.gitlab.com/ee/user/application_security/sast/)
- [ ] [Deploy to Kubernetes, Amazon EC2, or Amazon ECS using Auto Deploy](https://docs.gitlab.com/ee/topics/autodevops/requirements.html)
- [ ] [Use pull-based deployments for improved Kubernetes management](https://docs.gitlab.com/ee/user/clusters/agent/)
- [ ] [Set up protected environments](https://docs.gitlab.com/ee/ci/environments/protected_environments.html)

#アプリケーション名

    お問い合わせアプリ

#環境構築

    <Dockerビルド>

        1. git clone git@github.com:Tomey0219/suwa_ability_test.git
        2. docker-compose up -d --build

        ※MySQLは、OSによって起動しない場合があるのでそれぞれのPCに合わせてdocker-compose.ymlファイルを編集してください。
    
    <Laravel環境構築>

        1. docker-compose exec php bash
        2. composer install
        3. .env.exampleファイルから.envを作成し、環境変数を変更
        4. 時間設定を変更・・・app.phpの'timezone'を変更し、"$ php artisan tinker"
        5. php artisan key:generate
        6. php artisan migrate
        7. php artisan db:seed

#使用技術

    ・php:7.4.9
    ・Laravel:8.83.27
    ・mysql:8.0.26
    ・nginx:1.21.1

#URL

    ・お問い合わせフォーム入力ページ：http://localhost/
    ・お問い合わせフォーム確認ページ：http://localhost/confirm
    ・サンクスページ：http://localhost/thanks
    ・管理画面：http://localhost/admin
    ・ユーザ登録ページ：http://localhost/register
    ・ログインページ：http://localhost/login

#ER図

    ER_diagram.drawio.pngに記載
## Workdockとは

WorkdockはLaravelと一部Reactで作られたタスク管理＆タイムトラッキングツールです。

![01](https://user-images.githubusercontent.com/1312692/61922718-5eb21980-af9c-11e9-9287-8b4434e920d3.png)

![02](https://user-images.githubusercontent.com/1312692/61922736-72f61680-af9c-11e9-9492-a96915a2f434.png)

![03](https://user-images.githubusercontent.com/1312692/61922739-77223400-af9c-11e9-9315-9fe487119fca.png)

![workdock4](https://user-images.githubusercontent.com/1312692/66093258-7a542480-e5ca-11e9-8fff-978d45dd1555.png)

## 機能

* タスクの追加/編集/削除/一括削除
* 絞り込み検索
* タスクの時間計測
* プロジェクト（グループ）管理
* プロジェクトの追加/編集/削除
* ユーザーの作業レポート
* ユーザーの追加/編集/削除
* ユーザー権限

## インストール

    $ https://github.com/k-ishiwata/Workdock.git
    $ cd Workdock
    $ composer install
    $ cp .env.example .env
    $ php artisan key:generate
    $ npm install
    $ npm prod

## データベース設定

    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=homestead
    DB_USERNAME=homestead
    DB_PASSWORD=secret

## データベースの構築 

データベーステーブルの作成とダミーデータの投入

    $ php artisan migrate --seed    
    
ユーザーダミーデータだけ入れる場合

    $ php artisan migrate
    $ php artisan db:seed --class=UsersTableSeeder
    
## ログイン情報

ダミーデータを入れると下記でログインできます。

    ID: admin
    PW: admin

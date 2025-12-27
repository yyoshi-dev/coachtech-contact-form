# お問合せフォーム

## 環境構築

### Dockerビルド
1. リポジトリをクローン
    ```bash
    git clone git@github.com:yyoshi-dev/coachtech-contact-form.git
    ```

3. コンテナを起動
    ```bash
    docker compose up -d --build
    ```

### Laravel環境構築
1. PHPコンテナに接続
    ```bash
    docker compose exec php bash
    ```

2. コンテナ内で依存関係をインストール
    ```bash
    composer install
    ```

3. `.env.example`をコピーして`.env`を作成
    ```bash
    cp .env.example .env
    ```

4. `.env`ファイルのDB設定及びセッション設定を以下の通り修正
    ```ini
    # DB設定
    DB_CONNECTION=mysql
    DB_HOST=mysql
    DB_PORT=3306
    DB_DATABASE=laravel_db
    DB_USERNAME=laravel_user
    DB_PASSWORD=laravel_pass

    # セッション設定
    SESSION_DRIVER=file
    ```

5. アプリケーションキーを生成 (初回のみ)
    ```bash
    php artisan key:generate
    ```

6.  マイグレーションを実行
    ```bash
    php artisan migrate
    ```

7.  シーディングを実行
    ```bash
    php artisan db:seed
    ```


## 使用技術 (実行環境)
- PHP：8.4.16
- Laravel: 12.44.0
- MySQL: 8.0.40
- nginx: 1.27.2
- phpMyAdmin: 5.2.3

## ER図
![ER図](docs/er.drawio.png)

## URL (開発環境)
- お問合せフォーム画面: http://localhost/
- ユーザー登録画面: http://localhost/register
- ログイン画面: http://localhost/login
- phpMyAdmin: http://localhost:8080/
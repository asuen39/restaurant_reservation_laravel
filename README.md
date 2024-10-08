# 飲食店予約サービス

**概要説明**<br>
・企業のグループ会社の飲食店予約サービスシステムになります。<br>
飲食店予約サービスシステムとは、インターネットを通じてお店に予約できるシステムとなっています。

## 作成目的
・外部の飲食店予約サービスは手数料を取られる為自社予約サービスを持ちたい

## アプリケーションURL
- 会員登録ページ: /register
- ログインページ: /login
- ログインページ: /thanks
- 飲食店一覧ページ: /
- 飲食店詳細ページ: /detail/{shop_id}
- 予約決済ページ: /detail
- 予約&決済完了ページ: /done
- マイページ: /mypage
- マイページ-編集モーダル: /mypage
- マイページ-レビューモーダル: /mypage
- マイページ-QRモーダル: /mypage

## 他のリポジトリ
- git clone リンク: git@github.com:asuen39/restaurant_reservation_laravel.git</a>
- aws ec2: http://43.207.71.85/register

## 機能一覧
- 会員登録機能
- 会員登録時のバリデーション機能(FormRequest)
- 会員登録後の認証メール送信機能(AWS SES)
- 会員認証登録機能
- 会員認証登録完了後の遷移機能
- ログイン機能
- ログイン時のバリデーション機能(FormRequest)
- ログアウト機能
- ログインセッション確認機能
- 飲食店一覧検索機能
- 飲食店一覧-ページネーション機能
- 飲食店お気に入り機能
- 店舗予約機能
- 店舗予約時の日時カレンダー機能
- 店舗予約時の予約時間&人数表示機能
- 店舗予約時、選択項目に応じて送信formに反映する機能
- 店舗予約時のバリデーション機能(FormRequest)
- 店舗予約決済機能
- リマインダー実行時、予約当日確認メール送信機能(AWS SES)
- マイページ機能
- マイページ-店舗予約情報変更機能
- マイページ-店舗予約情報削除機能
- マイページ-レビュー評価一覧機能
- マイページ-レビュー評価登録機能
- マイページ-QRコード生成機能
- マイページ-QR認証機能
- レスポンシブデザイン(ブレイクポイント: 1200px以下、768px以下、480px以下)
- AWS EC2対応
- AWS RDS対応

## 使用技術
- PHP 8.3
- Laravel 8.83
- Laravel-Livewire
- Mysql 8.0
- bootstrap3
- jquery
- jquery.datetimepicker
- Font Awesome
- Stripe
- AWS EC2、RDS、S3
- AWS Simple Email Service<br>
・メール機能開通の為にお名前ドットコム (https://www.onamae.com/) で無料ドメインの取得<br>
・RDSでのドメイン登録

## テーブル設計
![table_image2](https://github.com/user-attachments/assets/f9965985-1236-4620-acda-d2d3dd3a3ebf)

## ER図
![er](https://github.com/user-attachments/assets/e7739f98-2f9d-413a-a133-79efeb2e36b9)


## 環境構築
- git cloneをする。
- docker-compose up -d --build
- ※Mysqlは環境によって起動しない場合があります。それぞれの環境に合わせてdocker-compose.ymlの編集を行ってください。
- ※osによってファイルの権限の指定する可能性があります。sudo chmod -R 777 * 等環境に合わせて指定してください。
- ※docker-compose絡みで解消出来ないエラーが発生した時 以下実行で解決出来ます。
- コンテナの停止
- コンテナの削除 (docker/mysql/dataディレクトリの削除)
- PC再起動後にdocker-compose build --no-cache
- docker-compose up -d

### laravel環境構築
- docker-compose exec php bash
- composer install
- .env.exampleからコピーして.env ファイル作成。環境変数を設定。データベースが作成されているか確認。
- php artisan key:generate
- php artisan migrate -テーブル作成
- php artisan db:seed　テーブルへデータの挿入

## 備考
- 会員登録をするとメールが送られるので(https://temp-mail.org/ja) メールボックスが開けるサービスのご用意をお願いします。
- 会員登録時にメールが送信されます。
- 決済画面でのテストコード:<br>
・カード番号: 4242 4242 4242 4242<br>
・有効期限: 12/24<br>
・セキュリティコード: 123<br>
- リマインダー機能の確認 ※ローカルでご確認お願いします。<br>
・店舗を訪問する当日の日で予約してください。<br>
・当日予約の状態でphp artisan send:reservation-remindersを実行すると確認メールが送られます。<br>
- QRコードは確認がやりづらいのでスクリーンショットを載せたスプレットシートを用意致しました。<br>
・https://docs.google.com/spreadsheets/d/1LUGSVZr9rSvMc_CU3vXED35HsJlNlWWZ82bVnFKt9jA/edit?pli=1&gid=1599820009#gid=1599820009<br>
・ローカルで確認時はスプレットシート記載の通り、QRコードの生成URLを変更する必要があります。<br>
・変更後はPCブラウザでアクセス可能です。スマートフォンでの確認は設定したURLにアクセス出来るよう調整する必要があります。<br>
・awsではデータベースの確認はできませんが読み取りは容易にできます。フラグが変化するスクリーンショットをスプレットシートに載せています。

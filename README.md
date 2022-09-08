# DAWN LESSON8 SNS
## 環境構築
DAWN-SNS環境構築手順書を参考に進めていく  
migrationのファイルはすでに用意されているので以下コマンドを実行でOK  
ただし仕様書とmigrationのカラム名が違うので修正が必要  
`php artisan migrate`

seederは用意がないので自分で用意する

C:\xampp\htdocs\dawnSNS-Laravel-6.20.43
起動時には対象のファイルがある場所で以下コマンドを実行
`php artisan serve`

## ユーザー登録、ログイン機能
1.CSSの調整
2.ユーザー登録（INSERT）
    バリデーションの設定
3.ユーザー情報の表示（READ）
4.ログイン&ログアウト
    controllerのconstructで認証させるのがうまくいかなかった
    web.phpで->middleware('auth')をつけて認証させている

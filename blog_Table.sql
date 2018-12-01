CREATE DATABASE blog DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

usersテーブル　//ユーザー登録
CREATE TABLE blog. users (
id INT( 11 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
username VARCHAR( 64 ) NOT NULL ,
email VARCHAR( 128 ) NOT NULL ,
password VARCHAR( 100 ) NOT NULL ,
UNIQUE (email)
);

postテーブル　//記事投稿
CREATE TABLE blog. posts (
id INT( 11 ) NOT NULL  AUTO_INCREMENT PRIMARY KEY ,
user_id INT( 11 ) NOT NULL ,
title VARCHAR( 128 ) NOT NULL ,
form VARCHAR( 64 )  NOT NULL ,
name VARCHAR( 64 )  NOT NULL ,
body TEXT  NOT NULL ,
create_at timestamp NOT NULL default current_timestamp,
updated_at timestamp NOT NULL default current_timestamp on update current_timestamp
);


機能一覧
公開用画面
記事一覧の表示（ページング, タグ絞り込み含む）
記事の閲覧
Twitterタイムラインの表示（ウィジェットとして）

管理用画面
記事一覧の表示（ページング含む）
記事の作成（Twitterへの通知含む）
記事の編集
記事の削除
ブログ全体の設定
認証（ベーシック認証を使用）
Twitter連携の有効／無効切り替え

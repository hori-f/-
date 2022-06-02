<?php

session_start();

define('DSN', 'mysql:host=db;dbname=myapp;charset=utf8mb4');
define('DB_USER', 'myappuser');
define('DB_PASS', 'myapppass');
define('SITE_URL', 'http://' . $_SERVER['HTTP_HOST']);
define('SITE_URL3', 'http://localhost:8562/index3.php');

require_once(__DIR__ . '/functions.php');


// PDOクラスの$bdhインスタンスを作成しています。
// $dbh = new PDO($dsn,$user,$password);
// 5:
// mysql:(データベースはmysqlですよ。)
// dbname=test;(データベース名はtestですよ。)
// host=localhost;(ホスト名はlocalhostですよ。)
// charset=utf8mb4(文字セットはUTF-8 Unicodeですよ。)
// 6:PDOクラスの$bdhインスタンスを作るのに必要な第２引数(ユーザ名)を、$user変数に文字列として代入しています。
// 7:PDOクラスの$bdhインスタンスを作るのに必要な第３引数(パスワード)を、$password変数に文字列として代入しています。

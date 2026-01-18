<?php
//共通に使う関数を記述
//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str){
    return htmlspecialchars($str, ENT_QUOTES);
}

//DB接続
function db_conn() {
  try {
    //ローカルホスト対応
    // $db_name = 'gs_db_0116kadai',
    // $db_host = 'localhost',
    // $db_id = 'root',
    // $db_pw = '';

    //デプロイ対応
    $db_name = '';  //データベース名
    $db_host = '';  //DBホスト
    $db_id = ''; //ユーザー名（さくらサーバーはDB名と同じ）
    $db_pw = ''; //パスワード
    $db_port = 3306; //ポート番号（さくらサーバーで確認必須）

    $server_info = 'mysql:dbname=' . $db_name . ';charset=utf8;host=' . $db_host . ';port=' . $db_port;
    $pdo = new PDO($server_info, $db_id, $db_pw, array(
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_TIMEOUT => 5
    ));
    return $pdo;
  } catch (PDOException $e) {
    exit('DBConnectError: ' . $e->getMessage());
  }
}

?>
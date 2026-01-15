<?php

$id = $_GET['id'];
require_once('funcs.php');
$pdo = db_conn(); //returnした関数内の$pdoを代入

//３．データ登録SQL作成
//３．データ登録SQL作成
$stmt = $pdo->prepare('DELETE FROM gs_one_table WHERE id = :id;');
$stmt->bindValue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute(); //実行

//４．データ登録処理後
if ($status === false) {
    //*** function化する！******\
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    //*** function化する！*****************
    header('Location: select.php');
    exit();
}

?>
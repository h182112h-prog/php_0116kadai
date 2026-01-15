<?php
//1. POSTデータ取得
//1. POSTデータ取得
$id = $_POST['id']; //<-忘れない
$name   = $_POST['name'];
$job_type  = $_POST['job_type'];
$annual_salary    = $_POST['annual_salary'];
$evaluation_2025h1 = $_POST['evaluation_2025h1'];
$evaluation_2025h2 = $_POST['evaluation_2025h2'];


//2. DB接続します
//*** function化する！  *****************
require_once('funcs.php');
$pdo = db_conn(); //returnした関数内の$pdoを代入


//３．データ登録SQL作成
   $stmt = $pdo->prepare('UPDATE
                            gs_one_table
                        SET
                            -- id = :id,
                            name = :name,
                            job_type = :job_type,
                            annual_salary = :annual_salary,
                            evaluation_2025h1 = :evaluation_2025h1,
                            evaluation_2025h2 = :evaluation_2025h2
                        WHERE id = :id;');

    // 数値の場合 PDO::PARAM_INT
    // 文字の場合 PDO::PARAM_STR
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':job_type', $job_type, PDO::PARAM_STR);
    $stmt->bindParam(':annual_salary', $annual_salary, PDO::PARAM_INT);
    $stmt->bindParam(':evaluation_2025h1', $evaluation_2025h1, PDO::PARAM_STR);
    $stmt->bindParam(':evaluation_2025h2', $evaluation_2025h2, PDO::PARAM_STR);
    $status = $stmt->execute(); //実行

    //４．データ登録処理後
    if ($status === false) {
    //*** function化する！******\
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
    } else {
    //*** function化する！*****************
    header('Location: index.php');
    exit();
    }

echo 'CSVアップロードが完了しました';



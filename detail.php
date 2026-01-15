<?php
$id = $_GET['id'];

// var_dump($id);

require_once('funcs.php');
$pdo = db_conn(); //returnした関数内の$pdoを代入

//２．データ登録SQL作成
$stmt = $pdo->prepare('SELECT * FROM gs_one_table WHERE id = :id; ');  // $idはNG
$stmt->bindvalue(':id', $id, PDO::PARAM_INT);
$status = $stmt->execute();

//３．データ表示
$result = '';
if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    $result = $stmt->fetch();
    // var_dump($result);　//consolelog的なやつ

    // echo '<pre>';
    // var_dump($result);
    // echo '</pre>';
 
}
?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>データ詳細</title>
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <header>
        <nav>
            <div>
                <div><a href="select.php">データ一覧</a></div>
            </div>
        </nav>
    </header>

    <!-- method, action, 各inputのnameを確認してください。  -->
    <form method="POST" action="update.php">
        <div>
            <fieldset>
                <legend>HRデータ</legend>
                <label>社員番号：<input type="text" name="id" value="<?= $result['id']?>"></label><br>
                <label>氏名：<input type="text" name="name" value="<?= $result['name']?>"></label><br>
                <label>職種：<input type="text" name="job_type" value="<?= $result['job_type']?>" ></label><br>
                <label>年収：<input type="text" name="annual_salary" value="<?= $result['annual_salary']?>" ></label><br>
                <label>2025年上期評価：<input type="text" name="evaluation_2025h1" value="<?= $result['evaluation_2025h1']?>" ></label><br>
                <label>2025年下期評価：<input type="text" name="evaluation_2025h2" value="<?= $result['evaluation_2025h2']?>" ></label><br>

                <input type="hidden" name="id" value="<?= $result['id']?>">
                <input type="submit" value="更新">
            </fieldset>
        </div>
    </form>
</body>

</html>
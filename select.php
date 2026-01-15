<?php
//【重要】
/**
 * DB接続のための関数をfuncs.phpに用意
 * require_onceでfuncs.phpを取得
 * 関数を使えるようにする。
 */


require_once('funcs.php');
$pdo = db_conn(); //returnした関数内の$pdoを代入

//２．データ登録SQL作成
$stmt = $pdo->prepare('SELECT * FROM gs_one_table;');
$status = $stmt->execute();

//３．データ表示
$view = '';
if ($status === false) {
    $error = $stmt->errorInfo();
    exit('SQLError:' . print_r($error, true));
} else {
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        //GETデータ送信リンク作成
        // <a>で囲う。
        // ↓HTMLタグで囲む！！（未対応）
        $view .= '<p>';
            $view .= '<a href="detail.php?id=' . $result['id'] . '">';
            $view .= $result['id'] . ' : ' . $result['name'] . ' : ' . $result['job_type'] . ' : ' . $result['annual_salary'] . ' : ' . $result['evaluation_2025h1'] . ' : ' . $result['evaluation_2025h2'];
            $view .= '</a>';

            $view .= '<a href="delete.php?id=' . $result['id'] . '">';
            $view .= '[削除]';
            $view .= '</a>';

        $view .= '</p>';
    }
}
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>登録データ表示</title>
    <link href="css/style.css" rel="stylesheet">
</head>

<body id="main">
    <!-- Head[Start] -->
    <header>
        <nav>
            <div>
                <div>
                    <a href="index.php">データ登録</a>
                </div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <div>
        <div>
            <a href="detail.php"></a>
            <?= $view ?>
        </div>
    </div>
    <!-- Main[End] -->

</body>

</html>
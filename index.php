<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>HRデータレイク</title>
    <!-- <link href="css/style.css" rel="stylesheet"> -->
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
   <form method="POST" action="insert.php" enctype="multipart/form-data">
        <div>
            <fieldset>
                <legend>HRデータアップロード</legend>
                  <!-- ① CSVファイルアップロード -->
                    <label for="csvFile">CSVファイルを選択：</label>
                    <input type="file" name="csv_file"><br>
                    <button type="submit">アップロード</button>
            </fieldset>
        </div>
    </form>
</body>

</html>
<?php

//1. POSTデータ取得
//ファイルは＄_POSTではなく$_FILESで受け取る
// $csv_file = $_FILES['csv_file']; 

    // echo '<pre>';
    // var_dump($csv_file);
    // echo '</pre>';

$fileName = $_FILES['csv_file']['name'];
$fileTmpName = $_FILES['csv_file']['tmp_name'];
    echo '<pre>';
    var_dump($fileName);
    var_dump($fileTmpName);
    echo '</pre>';

$dir = __DIR__ . '/csv/';

echo "ディレクトリのパス: " . $dir . "<br>";
echo "存在するか: " . (is_dir($dir) ? "YES" : "NO") . "<br>";
echo "書き込み可能か: " . (is_writable($dir) ? "YES" : "NO") . "<br>";
echo "PHPを実行しているユーザー: " . posix_getpwuid(posix_geteuid())['name'] . "<br>";

// ファイルパス
$file = __DIR__ . '/csv/'. $fileName;

    echo '<pre>';
    var_dump($file);
    echo '</pre>';

// CSVファイルをcsvディレクトリに保存する
// ターミナルへ↓を入力しないとアップロードできなかった。どうやらxampでのphp書き込み権限がないらしい
//chmod 777 /Applications/XAMPP/xamppfiles/htdocs/php_0116kadai/csv/
if(move_uploaded_file($fileTmpName, $file)){
    echo "ファイルが正常にアップロードされました。";
} else {
    echo "ファイルのアップロードに失敗しました。";
}

// csvディレクトリに保存したCSVファイルを読み込み、配列に置き換る。
$data = array_map('str_getcsv', file($file));

    echo '<pre>';
    var_dump($data);
    echo '</pre>';



//2. DB接続します
//*** function化する！  *****************
require_once('funcs.php');
$pdo = db_conn(); //returnした関数内の$pdoを代入



foreach ($data as $key => $row) {

// usersテーブルにデータを挿入する
    if($key === 0) {
      continue;
    }
    $id = $row[0];
    $name = $row[1];
    $job_type = $row[2];
    $annual_salary = $row[3];
    $evaluation_2025h1 = $row[4];
    $evaluation_2025h2 = $row[5];


//３．データ登録SQL作成
    $stmt = $db->prepare("INSERT INTO gs_one_table (id, name,job_type , annual_salary,evaluation_2025h1,evaluation_2025h2) VALUES (:id, :name,:job_type , :annual_salary,:evaluation_2025h1,:evaluation_2025h2)");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':job_type', $job_type);
    $stmt->bindParam(':annual_salary', $annual_salary);
    $stmt->bindParam(':evaluation_2025h1', $evaluation_2025h1);
    $stmt->bindParam(':evaluation_2025h2', $evaluation_2025h2);
    $stmt->execute();
  }
// echo 'CSVアップロードが完了しました';

?>
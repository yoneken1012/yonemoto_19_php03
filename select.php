<?php

//1.  DB接続
try {
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=yoneken_db1;charset=utf8;host=yone-ken.sakura.ne.jp','yone-ken','NTc-5AWP6mEu');
} catch (PDOException $e) {
  exit('DBConnectError'.$e->getMessage());
}

//２．データ取得SQL作成
$sql = "SELECT * FROM gs_bm_table ORDER BY date DESC";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();


//３．データ表示
if ($status === false) {
    //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("SQL_Error:".$error[2]);
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ブックマーク一覧</title>
</head>

<body>
<h1>ブックマーク一覧</h1>
<a href="index.php">← 登録画面へ戻る</a>
<hr>

<?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
    <p>
        <strong><?= htmlspecialchars($row["name"], ENT_QUOTES, "UTF-8") ?></strong><br>
        <a href="<?= htmlspecialchars($row["url"], ENT_QUOTES, "UTF-8") ?>" target="_blank">
        <?=  htmlspecialchars($row["url"], ENT_QUOTES, "UTF-8") ?>
        </a><br>
        <?= nl2br(htmlspecialchars($row["comment"], ENT_QUOTES, "UTF-8")) ?><br>
        <small><?=  $row["date"] ?></small>
    </p>
    <hr>
    <?php endwhile; ?>>
</body>

</html>
<?php
require_once "funcs.php";
require_once "db.php";

sschk(); // ★ログイン必須

$id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;
if ($id <= 0) exit("IDが不正です");

$pdo = db_conn();
$sql = "SELECT * FROM bm_items WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":id", $id, PDO::PARAM_INT);
$stmt->execute();
$row = $stmt->fetch();

if (!$row) exit("データが見つかりません");
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>詳細（ログイン必須）</title>
</head>
<body>
  <h1>詳細（ログイン必須）</h1>

  <p>
    ログイン中：<?= h($_SESSION["username"]) ?> /
    <a href="logout.php">ログアウト</a> |
    <a href="select.php">一覧へ</a>
  </p>

  <hr>

  <p><strong>書籍名：</strong><?= h($row["name"]) ?></p>
  <p><strong>URL：</strong><a href="<?= h($row["url"]) ?>" target="_blank"><?= h($row["url"]) ?></a></p>
  <p><strong>コメント：</strong><br><?= nl2br(h($row["comment"])) ?></p>
  <p><strong>登録日：</strong><?= h($row["date"]) ?></p>

  <hr>
  <p>
    <!-- 編集/削除は「この最小構成」では select.php の機能を使う -->
    <a href="select.php?id=<?= (int)$row["id"] ?>">一覧で編集</a> |
    <a href="select.php?act=del&id=<?= (int)$row["id"] ?>" onclick="return confirm('削除しますか？');">一覧で削除</a>
  </p>
</body>
</html>
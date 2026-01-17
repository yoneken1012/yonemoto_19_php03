<?php
// ========= DB接続 =========
try {
  //$pdo = new PDO('mysql:dbname=yoneken_db1;charset=utf8;host=yone-ken.sakura.ne.jp','yone-ken','NTc-5AWP6mEu');
  $pdo = new PDO('mysql:dbname=yoneken_db1;charset=utf8;host=localhost','yone-ken','NTc-5AWP6mEu'); // ユーザー名：root, PW：無し
} catch (PDOException $e) {
  exit('DBConnectError:'.$e->getMessage());
}

// ========= 削除処理（GET） =========
if (isset($_GET["act"]) && $_GET["act"] === "del") {
  $id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;
  if ($id > 0) {
    $sql = "DELETE FROM gs_bm_table WHERE id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $status = $stmt->execute();
    if ($status === false) {
      $error = $stmt->errorInfo();
      exit("SQL_Error:".$error[2]);
    }
  }
  header("Location: select.php");
  exit();
}

// ========= 更新処理（POST） =========
if (isset($_POST["act"]) && $_POST["act"] === "update") {
  $id      = isset($_POST["id"]) ? (int)$_POST["id"] : 0;
  $name    = $_POST["name"] ?? "";
  $url     = $_POST["url"] ?? "";
  $comment = $_POST["comment"] ?? "";

  if ($id > 0) {
    $sql = "UPDATE gs_bm_table
            SET name=:name, url=:url, comment=:comment
            WHERE id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':name', $name, PDO::PARAM_STR);
    $stmt->bindValue(':url', $url, PDO::PARAM_STR);
    $stmt->bindValue(':comment', $comment, PDO::PARAM_STR);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $status = $stmt->execute();

    if ($status === false) {
      $error = $stmt->errorInfo();
      exit("SQL_Error:".$error[2]);
    }
  }
  header("Location: select.php");
  exit();
}

// ========= 編集対象1件取得（GET id がある時） =========
$editRow = null;
if (isset($_GET["id"])) {
  $editId = (int)$_GET["id"];
  if ($editId > 0) {
    $sql = "SELECT * FROM gs_bm_table WHERE id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $editId, PDO::PARAM_INT);
    $status = $stmt->execute();
    if ($status === false) {
      $error = $stmt->errorInfo();
      exit("SQL_Error:".$error[2]);
    }
    $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
  }
}

// ========= 一覧取得 =========
$sql = "SELECT * FROM gs_bm_table ORDER BY date DESC";
$stmt = $pdo->prepare($sql);
$status = $stmt->execute();

if ($status === false) {
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

<?php if ($editRow) : ?>
  <h2>編集（ID: <?= (int)$editRow["id"] ?>）</h2>
  <form method="post" action="select.php">
    <input type="hidden" name="act" value="update">
    <input type="hidden" name="id" value="<?= (int)$editRow["id"] ?>">

    <div>
      <label>書籍名</label><br>
      <input type="text" name="name" value="<?= htmlspecialchars($editRow["name"], ENT_QUOTES, "UTF-8") ?>" required>
    </div>
    <br>

    <div>
      <label>書籍URL</label><br>
      <input type="url" name="url" value="<?= htmlspecialchars($editRow["url"], ENT_QUOTES, "UTF-8") ?>" required>
    </div>
    <br>

    <div>
      <label>コメント</label><br>
      <textarea name="comment" rows="4" required><?= htmlspecialchars($editRow["comment"], ENT_QUOTES, "UTF-8") ?></textarea>
    </div>
    <br>

    <button type="submit">更新</button>
    <a href="select.php">キャンセル</a>
  </form>
  <hr>
<?php endif; ?>

<?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
  <p>
    <strong><?= htmlspecialchars($row["name"], ENT_QUOTES, "UTF-8") ?></strong><br>

    <a href="<?= htmlspecialchars($row["url"], ENT_QUOTES, "UTF-8") ?>" target="_blank">
      <?= htmlspecialchars($row["url"], ENT_QUOTES, "UTF-8") ?>
    </a><br>

    <?= nl2br(htmlspecialchars($row["comment"], ENT_QUOTES, "UTF-8")) ?><br>
    <small><?= htmlspecialchars($row["date"], ENT_QUOTES, "UTF-8") ?></small><br>

    <a href="select.php?id=<?= (int)$row["id"] ?>">編集</a>
    |
    <a href="select.php?act=del&id=<?= (int)$row["id"] ?>" onclick="return confirm('削除しますか？');">削除</a>
  </p>
  <hr>
<?php endwhile; ?>

</body>
</html>
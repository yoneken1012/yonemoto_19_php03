<?php
require_once "funcs.php";
require_once "db.php";

$pdo = db_conn();

// ======== ログイン判定（一覧は公開） ========
$isLogin = is_login();

// ======== 削除処理（GET）※ログイン必須 ========
if ($isLogin && isset($_GET["act"]) && $_GET["act"] === "del") {
  $id = isset($_GET["id"]) ? (int)$_GET["id"] : 0;
  if ($id > 0) {
    $sql = "DELETE FROM bm_items WHERE id=:id";
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

// ======== 更新処理（POST）※ログイン必須 ========
if ($isLogin && isset($_POST["act"]) && $_POST["act"] === "update") {
  $id      = isset($_POST["id"]) ? (int)$_POST["id"] : 0;
  $name    = $_POST["name"] ?? "";
  $url     = $_POST["url"] ?? "";
  $comment = $_POST["comment"] ?? "";

  if ($id > 0) {
    $sql = "UPDATE bm_items
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

// ======== 編集対象1件取得（GET id）※ログイン必須 ========
$editRow = null;
if ($isLogin && isset($_GET["id"])) {
  $editId = (int)$_GET["id"];
  if ($editId > 0) {
    $sql = "SELECT * FROM bm_items WHERE id=:id";
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

// ======== 課題②：検索（ログイン不要の一覧でOK） ========
$q = $_GET["q"] ?? "";
$where = "";
if ($q !== "") {
  $where = "WHERE name LIKE :q OR url LIKE :q OR comment LIKE :q";
}

// ======== 一覧取得 ========
$sql = "SELECT * FROM bm_items $where ORDER BY date DESC";
$stmt = $pdo->prepare($sql);
if ($q !== "") {
  $stmt->bindValue(":q", "%".$q."%", PDO::PARAM_STR);
}
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
  <title>ブックマーク一覧（公開）</title>
</head>
<body>

<h1>ブックマーク一覧（公開）</h1>

<div>
  <?php if ($isLogin): ?>
    <p>
      ログイン中：<?= h($_SESSION["username"]) ?> /
      <a href="logout.php">ログアウト</a>
    </p>
  <?php else: ?>
    <p>
      <a href="login.php">ログイン</a>
      （詳細・編集・削除はログイン必須）
    </p>
  <?php endif; ?>
</div>

<p><a href="index.php">← 登録画面へ戻る</a></p>

<form method="get" action="select.php">
  <input type="text" name="q" value="<?= h($q) ?>" placeholder="検索（書籍名/URL/コメント）">
  <button type="submit">検索</button>
  <a href="select.php">クリア</a>
</form>

<hr>

<?php if ($isLogin && $editRow) : ?>
  <h2>編集（ID: <?= (int)$editRow["id"] ?>）</h2>
  <form method="post" action="select.php">
    <input type="hidden" name="act" value="update">
    <input type="hidden" name="id" value="<?= (int)$editRow["id"] ?>">

    <div>
      <label>書籍名</label><br>
      <input type="text" name="name" value="<?= h($editRow["name"]) ?>" required>
    </div>
    <br>

    <div>
      <label>書籍URL</label><br>
      <input type="url" name="url" value="<?= h($editRow["url"]) ?>" required>
    </div>
    <br>

    <div>
      <label>コメント</label><br>
      <textarea name="comment" rows="4" required><?= h($editRow["comment"]) ?></textarea>
    </div>
    <br>

    <button type="submit">更新</button>
    <a href="select.php">キャンセル</a>
  </form>
  <hr>
<?php endif; ?>

<?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) : ?>
  <p>
    <strong><?= h($row["name"]) ?></strong><br>

    <a href="<?= h($row["url"]) ?>" target="_blank">
      <?= h($row["url"]) ?>
    </a><br>

    <?= nl2br(h($row["comment"])) ?><br>
    <small><?= h($row["date"]) ?></small><br>

    <?php if ($isLogin): ?>
      <a href="detail.php?id=<?= (int)$row["id"] ?>">詳細</a> |
      <a href="select.php?id=<?= (int)$row["id"] ?>">編集</a> |
      <a href="select.php?act=del&id=<?= (int)$row["id"] ?>" onclick="return confirm('削除しますか？');">削除</a>
    <?php else: ?>
      <small>※詳細/編集/削除はログイン後に表示</small>
    <?php endif; ?>
  </p>
  <hr>
<?php endwhile; ?>

</body>
</html>
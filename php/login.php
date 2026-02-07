<?php
require_once "funcs.php";
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>ログイン</title>
</head>
<body>
  <h1>ログイン</h1>

  <form method="post" action="login_act.php">
    <div>
      <label>ユーザー名</label><br>
      <input type="text" name="username" required>
    </div>
    <br>
    <div>
      <label>パスワード</label><br>
      <input type="password" name="password" required>
    </div>
    <br>
    <button type="submit">ログイン</button>
  </form>

  <hr>
  <p><a href="select.php">一覧へ（ログイン不要）</a></p>
</body>
</html>
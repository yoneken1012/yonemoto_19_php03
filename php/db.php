<?php
// db.php
function db_conn(): PDO {
  try {
    // 自分のさくらサーバー環境に合わせる
    $pdo = new PDO(
      'mysql:dbname=yone-ken_db1;charset=utf8;host=mysql3112.db.sakura.ne.jp',
      'yone-ken_db1',
      '',
      [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      ]
    );
    return $pdo;
  } catch (PDOException $e) {
    exit('DBConnectError:'.$e->getMessage());
  }
}
<?php
// db.php
function db_conn(): PDO {
  try {
    // 自分のさくらサーバー環境に合わせる
    $pdo = new PDO(
      'mysql:dbname=yoneken_bm4;charset=utf8mb4;host=mysql3112.db.sakura.ne.jp',
      'yoneken_db1',
      'NTc-5AWP6mEu',
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
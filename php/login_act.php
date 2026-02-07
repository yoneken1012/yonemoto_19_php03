<?php
require_once "funcs.php";
require_once "db.php";

$username = $_POST["username"] ?? "";
$password = $_POST["password"] ?? "";

if ($username === "" || $password === "") {
  exit("入力が不足しています");
}

$pdo = db_conn();
$sql = "SELECT * FROM users WHERE username = :username LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":username", $username, PDO::PARAM_STR);
$stmt->execute();
$user = $stmt->fetch();

if (!$user) {
  exit("ユーザーが存在しません");
}

if (!password_verify($password, $user["password_hash"])) {
  exit("パスワードが違います");
}

// ログイン成功
$_SESSION["chk_ssid"] = session_id();
$_SESSION["user_id"]  = (int)$user["id"];
$_SESSION["username"] = $user["username"];

header("Location: select.php");
exit();
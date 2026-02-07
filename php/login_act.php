<?php
session_start();
require_once "db.php";
require_once "funcs.php";

$pdo = db_conn();

$username = $_POST["username"] ?? "";
$password = $_POST["password"] ?? "";

$sql = "SELECT * FROM users WHERE username=:username";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(":username", $username, PDO::PARAM_STR);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
  exit("ユーザーが存在しません");
}

if (!password_verify($password, $user["password"])) {
  exit("パスワードが違います");
}

// ログイン成功
$_SESSION["chk_ssid"] = session_id();
$_SESSION["username"] = $user["username"];

header("Location: select.php");
exit();

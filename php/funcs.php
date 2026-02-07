<?php
// funcs.php
session_start();

function h($str) {
  return htmlspecialchars($str, ENT_QUOTES, "UTF-8");
}

// ログインチェック（未ログインならloginへ）
function sschk() {
  if (!isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"] !== session_id()) {
    header("Location: login.php");
    exit();
  }
  // セッション固定化対策
  session_regenerate_id(true);
  $_SESSION["chk_ssid"] = session_id();
}

// ログイン中かどうか（一覧での出し分けに使う）
function is_login(): bool {
  return isset($_SESSION["chk_ssid"]) && $_SESSION["chk_ssid"] === session_id();
}
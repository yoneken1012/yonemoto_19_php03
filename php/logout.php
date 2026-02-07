<?php
require_once "funcs.php";

// セッション破棄
$_SESSION = [];
session_destroy();

header("Location: select.php");
exit();
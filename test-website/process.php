<?php
// 確保網頁使用 UTF-8，防止亂碼
header('Content-Type: text/html; charset=utf-8');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name'])) {
    $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');

    // 驗證名稱長度
    if (mb_strlen($name, 'UTF-8') < 3) {
        $_SESSION['errorMessage'] = '名字必須至少包含 3 個字符！';
    } else {
        $_SESSION['nameResponse'] = "你好, $name!";
    }
} else {
    $_SESSION['errorMessage'] = '請提交你的姓名';
}

// **確保 session 正確寫入**
session_write_close();
header('Location: index.php');
exit();

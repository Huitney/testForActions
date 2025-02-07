<?php
// 確保網頁使用 UTF-8，防止亂碼
header('Content-Type: text/html; charset=utf-8');

// 檢查是否有來自表單的 POST 請求
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['name'])) {
    // 防止 XSS 攻擊，轉義輸入內容
    $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
    
    // 回應使用者的輸入
    echo "<h1>你好, $name!</h1>";
} else {
    // 若未透過 POST 提交資料，則顯示錯誤訊息
    echo "<h1>請提交你的姓名</h1>";
}
?>

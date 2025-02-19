<?php
// 確保頁面以 UTF-8 輸出
header('Content-Type: text/html; charset=utf-8');

// 如果表單提交，顯示感謝訊息
if (isset($_POST['message'])) {
    echo "<h1>感謝您的聯繫，我們會儘快回覆您。</h1>";
}
?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>聯絡我們</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1><img src="./asset/img/contact me.png" with="200" heigh="200" alt="contact me.png">聯絡我們</h1>
    </header>
    <main>
        <form method="POST" action="">
            <label for="name">姓名:</label>
            <input type="text" id="name" name="name" required>
            
            <label for="email">電子郵件:</label>
            <input type="email" id="email" name="email" required>
            
            <label for="message">訊息:</label>
            <textarea id="message" name="message" required></textarea>
            
            <button type="submit">提交</button>
        </form>
    </main>
    <footer>
        <p>© 2025 測試網站. 版權所有.</p>
    </footer>
</body>
</html>

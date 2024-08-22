<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>簡易測試網站</title>
    <script src="script.js"></script>
</head>
<body>
    <h1>歡迎來到簡易測試網站</h1>
    
    <?php
    // 檢查是否有提交表單
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = htmlspecialchars($_POST['name']);
        echo "<h2>你好, " . $name . "!</h2>";
    }
    ?>

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="name">請輸入你的名字:</label>
        <input type="text" id="name" name="name" required>
        <input type="submit" value="提交">
    </form>

    <button type="button" onclick="showMessage()">顯示訊息</button>
    <p id="message"></p>

</body>
</html>

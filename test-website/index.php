<?php
// 確保頁面以 UTF-8 輸出
header('Content-Type: text/html; charset=utf-8');

// 檢查是否有來自 `process.php` 回傳的訊息
session_start();
$nameResponse = isset($_SESSION['nameResponse']) ? $_SESSION['nameResponse'] : '';
$errorMessage = isset($_SESSION['errorMessage']) ? $_SESSION['errorMessage'] : '';

// 清除 session 內容，防止刷新頁面時仍顯示舊訊息
unset($_SESSION['nameResponse']);
unset($_SESSION['errorMessage']);
?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>測試網站首頁</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <h1>歡迎來到測試網站</h1>
    <p>本網站用於測試自動化測試流程，包含多個網頁、圖片及測試腳本。</p>

    <?php
    $imagePath = "assets/img/large-image1.jpg";
    ?>
    <img src="<?php echo file_exists($imagePath) ? $imagePath : 'assets/img/default.png'; ?>" alt="測試圖片" width="600px">

    <form method="POST" action="process.php">
        <label for="name">姓名:</label>
        <input type="text" id="name" name="name" required>
        <button type="submit">提交</button>
    </form>

    <!-- 顯示來自 process.php 的錯誤或成功訊息 -->
    <?php if (!empty($errorMessage)) : ?>
        <div id="errorMessage" style="color: red;"><?php echo $errorMessage; ?></div>
    <?php endif; ?>

    <?php if (!empty($nameResponse)) : ?>
        <h1><?php echo $nameResponse; ?></h1>
    <?php endif; ?>

</body>
</html>

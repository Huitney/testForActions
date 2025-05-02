<?php
// 確保頁面以 UTF-8 輸出
header('Content-Type: text/html; charset=utf-8');

// 啟動 session，確保能讀取 `process.php` 設定的變數
session_start();

$nameResponse = isset($_SESSION['nameResponse']) ? $_SESSION['nameResponse'] : '';
$errorMessage = isset($_SESSION['errorMessage']) ? $_SESSION['errorMessage'] : '';

// **DEBUG：確認 session 內容**
error_log("DEBUG: nameResponse = " . $nameResponse);
error_log("DEBUG: errorMessage = " . $errorMessage);

// **清除 session 內容，防止刷新頁面時仍顯示舊訊息**
unset($_SESSION['nameResponse']);
unset($_SESSION['errorMessage']);
?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>測試網站首頁</title>
</head>
<body>
    <h1>歡迎來到測試網站</h1>
	<?php
	$imagePath = "assets/img/large-image1.jpg";
	?>
	<img src="<?php echo file_exists($imagePath) ? $imagePath : 'assets/img/default.png'; ?>" alt="測試圖片" width="600px">
    
    <?php if (!empty($errorMessage)) : ?>
        <div id="errorMessage" style="color: red;"><?php echo $errorMessage; ?></div>
    <?php endif; ?>

    <?php if (!empty($nameResponse)) : ?>
        <h2><?php echo $nameResponse; ?></h2>
    <?php endif; ?>

    <form method="POST" action="process.php">
        <label for="name">姓名:</label>
        <input type="text" id="name" name="name" required>
        <button type="submit">提交</button>
    </form>
</body>
</html>

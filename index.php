<?php
// 確保頁面以 UTF-8 輸出
header('Content-Type: text/html; charset=utf-8');

// 如果有 POST 資料，顯示 "你好, [name]!"
if (isset($_POST['name'])) {
    echo "<h1>你好, " . htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8') . "!</h1>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Form</title>
</head>
<body>
    <form method="POST" action="">
        <label for="name">Name: </label>
        <input type="text" id="name" name="name" required>
        <button type="submit">Submit</button>
    </form>
</body>
</html>

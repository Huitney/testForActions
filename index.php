<?php
// 确保页面以 UTF-8 输出
header('Content-Type: text/html; charset=utf-8');
// 输出 POST 数据以确认是否被传递
echo "<pre>";
print_r($_POST);
echo "</pre>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Form</title>
</head>
<body>
    <h1>你好, <?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : 'Guest'; ?>!</h1>
    <form method="POST" action="">
        <label for="name">Name: </label>
        <input type="text" id="name" name="name" required>
        <button type="submit">Submit</button>
    </form>
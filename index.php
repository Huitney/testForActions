<?php
// 確保頁面以 UTF-8 輸出
header('Content-Type: text/html; charset=utf-8');

// 如果有 POST 資料，顯示 "你好, [name]!"
if (isset($_POST['name'])) {
    echo "<h1>你好, " . htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8') . "!</h1>";
}
?>
<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>測試表單</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1 {
            color: #4CAF50;
        }
        form {
            margin-top: 20px;
        }
        label {
            font-size: 1.2em;
        }
        input[type="text"] {
            padding: 10px;
            font-size: 1em;
            margin-right: 10px;
        }
        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 1em;
            cursor: pointer;
            transition: transform 0.2s;
        }
        button[type="submit"]:hover {
            background-color: #45a049;
        }
        button[type="submit"]:active {
            transform: scale(0.95);
        }
        .error-message {
            color: red;
            font-size: 0.9em;
            margin-top: 5px;
        }
    </style>
</head>
<body>

    <h1 id="greeting">請輸入你的名字</h1>

    <form method="POST" action="" id="nameForm">
        <label for="name">姓名: </label>
        <input type="text" id="name" name="name" required>
        <button type="submit" id="submitBtn">提交</button>
        <div class="error-message" id="errorMessage"></div>
    </form>

    <script>
        // 獲取 DOM 元素
        const nameInput = document.getElementById('name');
        const greeting = document.getElementById('greeting');
        const form = document.getElementById('nameForm');
        const errorMessage = document.getElementById('errorMessage');
        const submitBtn = document.getElementById('submitBtn');

        // 當使用者在名稱輸入框中輸入時，及時更新標題
        nameInput.addEventListener('input', function() {
            const name = nameInput.value.trim();
            if (name.length > 0) {
                greeting.textContent = `你好, ${name}!`;
            } else {
                greeting.textContent = '請輸入你的名字';
            }
        });

        // 當表單被提交時，檢查名稱的長度
        form.addEventListener('submit', function(event) {
            const name = nameInput.value.trim();
            if (name.length < 3) {
                event.preventDefault(); // 阻止表單提交
                errorMessage.textContent = '名字必須至少包含 3 個字符！';
            } else {
                errorMessage.textContent = '';
                const confirmSubmit = confirm('你確定要提交嗎？');
                if (!confirmSubmit) {
                    event.preventDefault(); // 如果取消，則阻止表單提交
                }
            }
        });

        // 提交按鈕點擊效果
        submitBtn.addEventListener('click', function() {
            submitBtn.style.transform = 'scale(0.95)';
            setTimeout(() => {
                submitBtn.style.transform = 'scale(1)';
            }, 150);
        });
    </script>

</body>
</html>

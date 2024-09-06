<?php
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    // 測試 HTML 輸出是否包含預期的文本
    public function testHtmlOutput()
    {
        // 模擬 POST 請求
        $_POST['name'] = 'Alice';  // 模擬用戶輸入 "Alice"

        // 捕捉輸出
        ob_start(); // 開始緩衝輸出
        include '/var/www/testForActions/index.php'; // 包含 index.php 文件，這裡是渲染頁面的地方
        $output = ob_get_clean(); // 獲取緩衝區內容

        // 檢查輸出是否包含期望的文本 "你好, Alice!"
        $this->assertStringContainsString('你好, Alice!', $output);
    }

    // 測試表單提交後的輸出是否正確
    public function testFormSubmission()
    {
        // 模擬 POST 請求
        $_POST['name'] = 'Bob';  // 模擬用戶輸入 "Bob"

        // 捕捉輸出
        ob_start(); // 開始緩衝輸出
        include '/var/www/testForActions/index.php'; // 渲染頁面
        $output = ob_get_clean(); // 獲取緩衝區內容

        // 檢查輸出是否包含期望的文本 "你好, Bob!"
        $this->assertStringContainsString('你好, Bob!', $output);
    }
}

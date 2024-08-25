<?php
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    public function testHtmlOutput()
    {
        // 模擬表單提交的輸入
        $_POST['name'] = 'Alice';

        // 包含要測試的PHP文件
        ob_start();
        include '/var/www/my-repo/index.php';
        $output = ob_get_clean();

        // 檢查輸出是否包含預期的內容
        $this->assertStringContainsString('你好, Alice!', $output);
    }

    public function testFormSubmission()
    {
        // 測試表單是否正確提交並顯示預期結果
        $_POST['name'] = 'Bob';

        ob_start();
        include '/var/www/my-repo/index.php';
        $output = ob_get_clean();

        $this->assertStringContainsString('你好, Bob!', $output);
    }
}

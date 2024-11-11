<?php
use PHPUnit\Framework\TestCase;
mb_internal_encoding("UTF-8");

class ExampleTest extends TestCase
{
    private $tested_file = '/var/www/testForActions/index.php';

    public function testHtmlOutput()
    {
        $_POST['name'] = 'Alice';

        ob_start();
        include $this->tested_file;
        $output = ob_get_clean();

        // 確保捕捉的輸出內容是 UTF-8
        $output = mb_convert_encoding($output, 'UTF-8', 'auto');

        // 檢查輸出是否包含 "你好, Alice!"
        $this->assertStringContainsString('你好, Alice!', $output);
    }

    public function testFormSubmission()
    {
        $_POST['name'] = 'Bob';

        ob_start();
        include $this->tested_file;
        $output = ob_get_clean();

        // 確保捕捉的輸出內容是 UTF-8
        $output = mb_convert_encoding($output, 'UTF-8', 'auto');

        // 檢查輸出是否包含 "你好, Bob!"
        $this->assertStringContainsString('你好, Bob!', $output);
    }
}

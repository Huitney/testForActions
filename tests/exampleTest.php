<?php
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    public function testHtmlOutput()
    {
        $_POST['name'] = 'Alice';

        ob_start();
        include '/var/www/testForActions/index.php';
        $output = ob_get_clean();

        // 確保捕捉的輸出內容是 UTF-8
        $output = mb_convert_encoding($output, 'UTF-8', 'auto');

        $this->assertStringContainsString('你好, Alice!', $output);
    }

    public function testFormSubmission()
    {
        $_POST['name'] = 'Bob';

        ob_start();
        include '/var/www/testForActions/index.php';
        $output = ob_get_clean();

        // 確保捕捉的輸出內容是 UTF-8
        $output = mb_convert_encoding($output, 'UTF-8', 'auto');

        $this->assertStringContainsString('你好, Bob!', $output);
    }
}

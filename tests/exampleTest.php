<?php
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    // 测试页面输出是否正确
    public function testHtmlOutput()
    {
        // 模拟表单提交的输入
        $_POST['name'] = 'Alice';

        // 开始缓冲输出
        ob_start();
        include '/var/www/testForActions/index.php'; // 包含要测试的 PHP 文件
        $output = ob_get_clean(); // 捕捉输出

        // 调试输出，检查输出内容
        var_dump($output);

        // 检查输出是否包含预期的结果
        $this->assertStringContainsString('你好, Alice!', $output);
    }

    // 测试表单提交的输出
    public function testFormSubmission()
    {
        // 模拟另一表单提交
        $_POST['name'] = 'Bob';

        // 开始缓冲输出
        ob_start();
        include '/var/www/testForActions/index.php'; // 渲染页面
        $output = ob_get_clean(); // 捕捉输出

        // 调试输出
        var_dump($output);

        // 检查输出是否包含预期的值
        $this->assertStringContainsString('你好, Bob!', $output);
    }
}

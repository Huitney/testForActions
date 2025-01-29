<?php
use PHPUnit\Framework\TestCase;
mb_internal_encoding("UTF-8");

class WebsiteTest extends TestCase {
    public function testFormSubmission() {
        $response = file_get_contents('http://140.129.13.169/test-website/index.php');
        $this->assertStringContainsString('請輸入你的名字', $response);
    }
}
?>

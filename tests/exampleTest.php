<?php
use PHPUnit\Framework\TestCase;
mb_internal_encoding("UTF-8");

class ExampleTest extends TestCase {
    public function testHomePageLoads() {
        $response = file_get_contents('http://140.129.13.169/test-website/index.php');
        $this->assertStringContainsString('歡迎來到測試網站', $response);
    }

    public function testFormSubmission() {
        $data = http_build_query(['name' => '測試名稱']);
        $options = [
            'http' => [
                'header'  => "Content-type: application/x-www-form-urlencoded",
                'method'  => 'POST',
                'content' => $data
            ]
        ];
        $context  = stream_context_create($options);
        $result = file_get_contents('http://140.129.13.169/test-website/process.php', false, $context);
        
        $this->assertStringContainsString('你好, 測試名稱!', $result);
    }

    public function testImageExists() {
        $headers = get_headers('http://140.129.13.169/test-website/assets/img/large-image1.jpg', 1);
        $this->assertTrue(strpos($headers[0], "200") !== false);
    }
}
?>

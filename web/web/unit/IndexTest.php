<?php
use PHPUnit\Framework\TestCase;

class IndexTest extends TestCase {
    public function testIndexPage() {
        $output = file_get_contents(__DIR__ . '/../src/index.php');
        $this->assertStringContainsString('<h1>My Website</h1>', $output);
    }
}
?>
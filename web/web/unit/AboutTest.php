<?php
use PHPUnit\Framework\TestCase;

class AboutTest extends TestCase {
    public function testAboutPage() {
        $output = file_get_contents(__DIR__ . '/../src/about.php');
        $this->assertStringContainsString('<h2>About Us</h2>', $output);
    }
}

<?php
use PHPUnit\Framework\TestCase;

class MainTemplateTest extends TestCase {
    public function testMainTemplate() {
        ob_start();
        include __DIR__ . '/../src/templates/main.php';
        $output = ob_get_clean();
        $this->assertStringContainsString('<h2>Main Content</h2>', $output);
    }
}
?>
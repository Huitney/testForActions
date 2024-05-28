<?php
use PHPUnit\Framework\TestCase;

class SidebarTemplateTest extends TestCase {
    public function testSidebarTemplate() {
        ob_start();
        include __DIR__ . '/../src/templates/sidebar.php';
        $output = ob_get_clean();
        $this->assertStringContainsString('<h2>Sidebar</h2>', $output);
    }
}

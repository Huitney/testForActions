<?php
use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase {
    public function testDatabaseConnection() {
        include __DIR__ . '/../src/includes/config.php';
        $this->assertInstanceOf(PDO::class, $pdo);
    }
}

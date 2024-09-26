<?php
error_reporting(E_ALL); // 顯示所有 PHP 錯誤
ini_set('display_errors', 1); // 打開顯示錯誤

$conn = new mysqli('localhost', 'ci_user', 'ci_password', 'ci_test_reports');

if ($conn->connect_error) {
    die(json_encode(["error" => "Connection failed: " . $conn->connect_error]));
}

$sql = "SELECT test_name, status, COUNT(*) as count FROM test_results GROUP BY test_name, status";
$result = $conn->query($sql);

$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    $data[] = ["error" => "No results found"];
}

echo json_encode($data);
$conn->close();
?>

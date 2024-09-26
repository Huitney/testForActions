<?php
$conn = new mysqli('localhost', 'ci_user', 'ci_password', 'ci_test_reports');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT test_name, status, COUNT(*) as count FROM test_results GROUP BY test_name, status";
$result = $conn->query($sql);

$data = [];
while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);

$conn->close();
?>

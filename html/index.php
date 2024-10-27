<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CI/CD Test Results</title>
</head>
<body>
    <h1>Continuous Integration Test Results</h1>
    
    <h2>Test Summary</h2>
    <?php
    $conn = new mysqli("localhost", "ci_user", "ci_password", "ci_test_reports");

    // 檢查連接
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // 從資料庫中提取總成功和總失敗的數據
    $result = $conn->query("SELECT status, COUNT(*) as count FROM test_results GROUP BY status");

    echo "<ul>";
    while($row = $result->fetch_assoc()) {
        echo "<li>Status: " . $row["status"] . " - Count: " . $row["count"] . "</li>";
    }
    echo "</ul>";

    // 顯示最近的測試結果
    echo "<h2>Recent Test Results</h2>";
    $recent_tests = $conn->query("SELECT test_name, status, result FROM test_results ORDER BY id DESC LIMIT 3");

    echo "<table border='1'>
    <tr>
        <th>Test Name</th>
        <th>Status</th>
        <th>Result</th>
    </tr>";

    while($row = $recent_tests->fetch_assoc()) {
        echo "<tr>
            <td>" . $row["test_name"] . "</td>
            <td>" . $row["status"] . "</td>
            <td>" . substr($row["result"], 0, null) . "...</td>
        </tr>";
    }
    echo "</table>";

    $conn->close();
    ?>
</body>
</html>

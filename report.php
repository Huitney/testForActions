<?php
// 設置顯示所有錯誤，方便調試
error_reporting(E_ALL);
ini_set('display_errors', 1);

// 資料庫連線設定
$conn = new mysqli('localhost', 'ci_user', 'ci_password', 'ci_test_reports');

// 確認資料庫連線是否成功
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL 查詢
$sql = "SELECT test_name, status, COUNT(*) as count FROM test_results GROUP BY test_name, status";
$result = $conn->query($sql);

// 初始化數據陣列
$data = [];

// 檢查是否有查詢結果
if ($result->num_rows > 0) {
    // 遍歷查詢結果
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    echo "No results found";
}

// 回傳 JSON 格式的數據
echo json_encode($data);

// 關閉資料庫連線
$conn->close();
?>

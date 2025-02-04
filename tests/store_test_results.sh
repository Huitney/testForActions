#!/bin/bash

# MySQL 資訊
DB_USER="ci_user"
DB_PASS="ci_password"
DB_NAME="ci_test_reports"
TABLE_NAME="test_results_manual"

# 檢查並建立表格
mysql -u $DB_USER -p$DB_PASS -D $DB_NAME -e "
CREATE TABLE IF NOT EXISTS ${TABLE_NAME} (
    id INT AUTO_INCREMENT PRIMARY KEY,
    test_name VARCHAR(255),
    test_location VARCHAR(255),
    line VARCHAR(255) DEFAULT NULL,
    error_count VARCHAR(50),
    error_location TEXT,
    status VARCHAR(50),
    log TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);"

# 定義測試結果變數
TEST_NAME="$1"       # 測試名稱
TEST_LOCATION="$2"   # 測試執行位置
LOG_FILE="$3"        # 測試結果 log 檔案

# 解析測試結果
ERROR_COUNT=$(grep -c "ERROR\|FAIL" "$LOG_FILE" || echo "0")
ERROR_LOCATION=$(grep -oP "at .*:\d+" "$LOG_FILE" || echo "無")
LINE=$(grep -oP "(?<=:)\d+" "$LOG_FILE" | tr '\n' ',' | sed 's/,$//' || echo "NULL")
LOG_CONTENT=$(cat "$LOG_FILE" | tr -d "'\n\r")

# 設定測試狀態
STATUS="success"
if [ "$ERROR_COUNT" -gt 0 ]; then STATUS="failure"; fi

# 儲存測試結果到 MySQL
mysql -u $DB_USER -p$DB_PASS -D $DB_NAME -e "
INSERT INTO ${TABLE_NAME} (test_name, test_location, line, error_count, error_location, status, log)
VALUES ('$TEST_NAME', '$TEST_LOCATION', '$LINE', '$ERROR_COUNT', '$ERROR_LOCATION', '$STATUS', '$LOG_CONTENT');
"

echo "✅ 測試結果已儲存到 MySQL：$TEST_NAME"

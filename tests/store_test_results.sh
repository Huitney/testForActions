#!/bin/bash

# MySQL 資訊
DB_USER="ci_user"
DB_PASS="ci_password"
DB_NAME="ci_test_reports"
TABLE_NAME="test_results_manual"

# 確保表格存在
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

# 解析命令行參數
TEST_NAME="$1"       # 測試名稱
TEST_LOCATION="$2"   # 測試執行位置
LOG_FILE="$3"        # 測試結果 log 檔案

# 確保 LOG_FILE 存在
if [ ! -f "$LOG_FILE" ]; then
    echo "⚠️  錯誤：測試結果檔案 '$LOG_FILE' 不存在！"
    exit 1
fi

# 解析測試結果
status="success"
error_count=$(grep -c "ERROR" "$LOG_FILE" || echo "0")
error_location=$(grep -oP "at .*:\d+" "$LOG_FILE" || echo "無")
line=$(grep -oP "(?<=:)\d+" "$LOG_FILE" | tr '\n' ',' | sed 's/,$//' || echo "NULL")
line="'$line'"
log=$(cat "$LOG_FILE" | sed ':a;N;$!ba;s/\n/ /g' | tr -d "'\r")
if grep -q "ERROR" "$LOG_FILE"; then status="failure"; fi



# 儲存測試結果到 MySQL
mysql -u $DB_USER -p$DB_PASS -D $DB_NAME -e "
INSERT INTO ${TABLE_NAME} (test_name, test_location, line, error_count, error_location, status, log)
VALUES ('$TEST_NAME', '$TEST_LOCATION', $line, '$error_count', '$error_location', 'status', '$log');
"

echo "✅ 測試結果已儲存到 MySQL：$TEST_NAME"

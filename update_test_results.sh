#!/bin/bash

# 設定存儲數據的 JSON 文件路徑
DATA_FILE="/var/www/html/data.json"

# 模擬獲取測試結果的過程（實際數據可以從其他來源獲取，例如CI/CD工具的輸出文件）
SUCCESS_TESTS=5
FAILED_TESTS=2
TOTAL_ERRORS=3

# 模擬每個測試中的錯誤數量
PHP_TEST_ERRORS=1
JS_TEST_ERRORS=2
SNYK_TEST_ERRORS=0

# 獲取當前時間來記錄測試的最新更新時間
LAST_UPDATED=$(date +"%Y-%m-%d %H:%M:%S")

# 將測試結果寫入 JSON 文件
cat << EOF > $DATA_FILE
{
    "summary": {
        "total_success": $SUCCESS_TESTS,
        "total_failure": $FAILED_TESTS,
        "total_errors": $TOTAL_ERRORS,
        "last_updated": "$LAST_UPDATED"
    },
    "test_details": [
        {
            "test_name": "PHP Unit Tests",
            "status": "success",
            "error_count": $PHP_TEST_ERRORS
        },
        {
            "test_name": "JavaScript Tests",
            "status": "failure",
            "error_count": $JS_TEST_ERRORS
        },
        {
            "test_name": "Snyk Security Tests",
            "status": "success",
            "error_count": $SNYK_TEST_ERRORS
        }
    ]
}
EOF

echo "Test results updated in $DATA_FILE"

#!/bin/bash

# 假設有變量來保存測試結果
total_success=5  # 這裡應該是實際計算出來的數據
total_failure=2
total_errors=7
last_updated=$(date "+%Y-%m-%d %H:%M:%S")

# 測試細節模擬數據
cat <<EOT > /var/www/html/data.json
{
    "summary": {
        "total_success": $total_success,
        "total_failure": $total_failure,
        "total_errors": $total_errors,
        "last_updated": "$last_updated"
    },
    "test_details": [
        {
            "test_name": "PHP Unit Tests",
            "status": "success",
            "error_count": 0
        },
        {
            "test_name": "JavaScript Tests",
            "status": "failure",
            "error_count": 2
        },
        {
            "test_name": "Snyk Security Tests",
            "status": "success",
            "error_count": 0
        }
    ]
}
EOT

echo "Test results have been written to /var/www/html/data.json"

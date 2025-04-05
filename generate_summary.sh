#!/bin/bash

LOG_FILE="/var/www/testForActions/sonarqube_scan_result.log"
OUTPUT_FILE="/var/www/testForActions/sonarqube_test_result.log"

echo "=== SonarQube Summary Report ===" > "$OUTPUT_FILE"
echo "Generated on: $(date)" >> "$OUTPUT_FILE"
echo "" >> "$OUTPUT_FILE"

# 判斷是否成功
if grep -q "ANALYSIS SUCCESSFUL" "$LOG_FILE"; then
  echo "Status       : ✅ SUCCESS" >> "$OUTPUT_FILE"
else
  echo "Status       : ❌ FAILURE" >> "$OUTPUT_FILE"
fi

# 擷取耗時
grep "Analysis total time" "$LOG_FILE" >> "$OUTPUT_FILE"
grep "Final Memory" "$LOG_FILE" >> "$OUTPUT_FILE"
echo "" >> "$OUTPUT_FILE"

# 擷取錯誤和警告
echo "Errors:" >> "$OUTPUT_FILE"
grep "ERROR" "$LOG_FILE" | sed 's/^/  - /' >> "$OUTPUT_FILE" || echo "  - None" >> "$OUTPUT_FILE"

echo "" >> "$OUTPUT_FILE"
echo "Warnings:" >> "$OUTPUT_FILE"
grep "WARN" "$LOG_FILE" | sed 's/^/  - /' >> "$OUTPUT_FILE" || echo "  - None" >> "$OUTPUT_FILE"

echo "" >> "$OUTPUT_FILE"
echo "Dashboard:" >> "$OUTPUT_FILE"
grep "http://localhost:9000/dashboard" "$LOG_FILE" | sed 's/^/  - /' >> "$OUTPUT_FILE"

echo ""
echo "✅ Summary saved to: $OUTPUT_FILE"

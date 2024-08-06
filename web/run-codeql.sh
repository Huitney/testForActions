#!/bin/bash

# 停止腳本如果有錯誤
set -e

# 設定查詢庫的位置
CODEQL_REPO="/opt/codeql"
QUERY_PACK="$CODEQL_REPO/javascript/ql/src/codeql-suites/javascript-security-extended.qls"

# 如果 CodeQL 查詢庫目錄已經存在，刪除它
if [ -d "$CODEQL_REPO" ]; then
    echo "Removing existing CodeQL repository..."
    rm -rf "$CODEQL_REPO"
fi

# 克隆 CodeQL 查詢庫
echo "Cloning CodeQL repository..."
git clone https://github.com/github/codeql.git "$CODEQL_REPO"

# 刪除現有的 CodeQL 數據庫目錄（如果存在）
if [ -d "codeql-db" ]; then
    echo "Removing existing CodeQL database directory..."
    rm -rf codeql-db
fi

echo "Running CodeQL analysis..."
codeql database create codeql-db --language=javascript --source-root . --overwrite || { echo 'Failed to create database'; exit 1; }
codeql database analyze codeql-db $QUERY_PACK --format=sarif-latest --output=codeql-results.sarif || { echo 'Failed to analyze database'; exit 1; }
echo "CodeQL analysis complete. Results saved to codeql-results.sarif"

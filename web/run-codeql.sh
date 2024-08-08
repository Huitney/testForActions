#!/bin/bash

# 停止腳本如果有錯誤
set -e

# 設定查詢庫的位置
CODEQL_REPO="/opt/codeql"
QUERY_PACK="$CODEQL_REPO/javascript/ql/src/codeql-suites/javascript-security-and-quality.qls"

# 克隆 CodeQL 查詢庫（如果沒有克隆過）
if [ ! -d "$CODEQL_REPO" ]; then
    echo "Cloning CodeQL repository..."
    git clone https://github.com/github/codeql.git "$CODEQL_REPO"
else
    echo "CodeQL repository already exists."
fi

# 確認查詢包存在
if [ ! -f "$QUERY_PACK" ]; then
    echo "Error: Query pack $QUERY_PACK not found."
    exit 1
fi

# 檢查是否存在現有的 CodeQL 數據庫目錄
if [ -d "codeql-db" ]; then
    echo "CodeQL database directory already exists. Overwriting..."
    rm -rf codeql-db/*
fi

# 確認 autobuild.sh 腳本存在
if [ ! -f "$CODEQL_REPO/javascript/tools/autobuild.sh" ]; then
    echo "Error: autobuild.sh not found in $CODEQL_REPO/javascript/tools"
    ls -lR "$CODEQL_REPO/javascript"
    exit 1
fi

echo "Running CodeQL analysis..."
/usr/local/bin/codeql database create codeql-db --language=javascript --source-root . --overwrite || { echo 'Failed to create database'; exit 1; }
/usr/local/bin/codeql database analyze codeql-db $QUERY_PACK --format=sarif-latest --output=codeql-results.sarif || { echo 'Failed to analyze database'; exit 1; }
echo "CodeQL analysis complete. Results saved to codeql-results.sarif"

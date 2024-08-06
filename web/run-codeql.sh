#!/bin/bash

# 停止腳本如果有錯誤
set -e

# 設定查詢庫的位置
CODEQL_REPO="codeql"
QUERY_PACK="codeql/javascript-queries"

# 克隆 CodeQL 查詢庫（如果沒有克隆過）
if [ ! -d "$CODEQL_REPO" ]; then
    echo "Cloning CodeQL repository..."
    git clone https://github.com/github/codeql.git $CODEQL_REPO
else
    echo "CodeQL repository already exists."
fi

# 刪除現有的 CodeQL 數據庫目錄（如果存在）
if [ -d "codeql-db" ]; then
    echo "Removing existing CodeQL database directory..."
    rm -rf codeql-db
fi

echo "Running CodeQL analysis..."
codeql database create codeql-db --language=javascript --source-root .
codeql database analyze codeql-db $QUERY_PACK --format=sarif-latest --output=codeql-results.sarif
echo "CodeQL analysis complete. Results saved to codeql-results.sarif"

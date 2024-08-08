#!/bin/bash

# 停止腳本如果有錯誤
set -e

# 設定查詢庫的位置
CODEQL_REPO="/opt/codeql"
QUERY_PACK="$CODEQL_REPO/javascript/ql/src/codeql-suites/javascript-security-extended.qls"

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
   

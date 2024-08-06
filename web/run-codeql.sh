#!/bin/bash

# 停止腳本如果有錯誤
set -e

echo "Running CodeQL analysis..."
codeql database create codeql-db --language=javascript --source-root .
codeql database analyze codeql-db --format=sarif-latest --output=codeql-results.sarif
echo "CodeQL analysis complete. Results saved to codeql-results.sarif"

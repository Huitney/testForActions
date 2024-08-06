#!/bin/bash

# 停止腳本如果有錯誤
set -e

echo "Running Snyk dependency scan..."
snyk test --file=package.json --json > snyk-dependency-results.json
echo "Snyk dependency scan complete. Results saved to snyk-dependency-results.json"

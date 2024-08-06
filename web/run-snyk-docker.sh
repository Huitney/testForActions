#!/bin/bash

# 停止腳本如果有錯誤
set -e

echo "Running Snyk Docker container scan..."
snyk container test <docker-image> --json > snyk-docker-results.json
echo "Snyk Docker container scan complete. Results saved to snyk-docker-results.json"

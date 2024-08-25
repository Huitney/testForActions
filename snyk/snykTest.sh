#!/bin/bash

# 進入項目目錄
cd /var/www/my-repo

# 運行Snyk測試
snyk test --all-projects

#!/bin/bash

# 拉取最新代码
git pull origin main

# 构建并启动 Docker 容器
docker-compose up -d --build

# 清理未使用的 Docker 镜像和容器
docker system prune -f

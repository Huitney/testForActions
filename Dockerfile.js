FROM node:18
WORKDIR /app
COPY . /app

# 安裝 Node.js 依賴
RUN npm install

# 設置正確的權限（視情況需要）
RUN chown -R node:node /app && chmod -R 755 /app

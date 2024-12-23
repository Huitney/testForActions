FROM node:lts

# 設置工作目錄
WORKDIR /app

# 複製代碼到容器
COPY . /app

# 安裝專案依賴項
RUN npm install

# 設置正確的權限（如果需要）
RUN chown -R node:node /app && chmod -R 755 /app

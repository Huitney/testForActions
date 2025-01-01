FROM node:lts

WORKDIR /app

COPY . /app

RUN npm install

# 安裝 Babel 和 Jest 必需的依賴
RUN npm install --save-dev @babel/core @babel/preset-env babel-jest jest

# 設置正確的權限（如果需要）
RUN chown -R node:node /app && chmod -R 755 /app

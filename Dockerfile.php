FROM php:8.3-cli

# 設置工作目錄
WORKDIR /app

# 複製代碼到容器
COPY . /app

# 更新系統並安裝必要依賴
RUN apt-get update && apt-get install -y \
    zip \
    unzip \
    php-xml \
    php-dom \
    && apt-get clean

# 安裝 Composer
RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/local/bin/composer

# 安裝專案依賴項
RUN composer install

# 設置正確的權限（如果需要）
RUN chown -R www-data:www-data /app && chmod -R 755 /app

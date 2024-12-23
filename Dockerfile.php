FROM php:8.2-cli
WORKDIR /app
COPY . /app

# 安裝 PHP Composer 和所需依賴
RUN apt-get update && apt-get install -y zip unzip && \
    curl -sS https://getcomposer.org/installer | php && \
    php composer.phar install

# 設置正確的權限（視情況需要）
RUN chown -R www-data:www-data /app && chmod -R 755 /app

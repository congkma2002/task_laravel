FROM php:8.2-fpm

# Cài các extension PHP cần thiết cho Laravel
RUN docker-php-ext-install pdo pdo_mysql

# Sao chép mã nguồn vào container
WORKDIR /var/www/html

COPY . .

# Đặt quyền phù hợp
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# PHP-FPM chạy trên cổng 9000 mặc định 
EXPOSE 9000

FROM php:8.4.8-fpm

WORKDIR /var/www/html

RUN apt-get update && \
    apt-get install -y \
        git \
        curl \
        libpng-dev \
        libonig-dev \
        libxml2-dev \
        zip \
        unzip \
        libzip-dev \
    && docker-php-ext-install -j$(nproc) \
        zip \
        pdo_mysql \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd

RUN apt-get install -y python3 python3-pip python3-venv && \
    python3 -m venv .venv && \
    . .venv/bin/activate && \
    pip install --upgrade pip setuptools && \
    pip install curl_cffi undetected-chromedriver webdriver-manager

RUN { \
    echo ';; Strict PHP Configuration'; \
    echo 'error_reporting = E_ALL'; \
    echo 'display_startup_errors = On'; \
    echo 'display_errors = On'; \
    echo 'log_errors = On'; \
    echo 'error_log = /var/log/php_errors.log'; \
    echo 'zend.assertions = 1'; \
    echo 'assert.exception = 1'; \
    echo 'strict_types = 1'; \
    echo 'opcache.enable = 1'; \
    echo 'opcache.enable_cli = 1'; \
    echo 'opcache.validate_timestamps = 1'; \
    echo 'opcache.save_comments = 1'; \
    echo 'session.use_strict_mode = 1'; \
} > /usr/local/etc/php/conf.d/strict.ini

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY composer.json composer.lock ./

RUN composer install --no-scripts

COPY . .

EXPOSE 80

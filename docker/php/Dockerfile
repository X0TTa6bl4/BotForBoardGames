FROM php:8.3-fpm

RUN apt-get update && apt-get install -y \
       libpq-dev \
        wget \
        zlib1g-dev \
        libmcrypt-dev \
        libzip-dev \
        openssl \
        git \
        zip \
        unzip \
        jq

RUN docker-php-ext-install pdo pdo_pgsql
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /www

COPY ./entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh
ENTRYPOINT ["entrypoint.sh"]
CMD ["php-fpm"]

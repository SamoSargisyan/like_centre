FROM php:7.4-fpm

RUN apt-get update && apt-get install -y \
        git \
        libcurl4-gnutls-dev \
        wget \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libzip-dev \
        libxslt-dev \
        libonig-dev \
        libbz2-dev \
        libpq-dev \
        libpng-dev zlib1g-dev libicu-dev g++ libmagickwand-dev --no-install-recommends libxml2-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl \
    && docker-php-ext-install  mysqli zip  gd xsl  calendar pgsql pdo_pgsql\
    && docker-php-ext-install bz2 \
    && pecl install imagick \
    && docker-php-ext-enable imagick \
    && pecl install xdebug-2.9.5 \
    && docker-php-ext-enable xdebug \
    && pecl install mailparse \
    && docker-php-ext-enable mailparse pgsql pdo_pgsql

ADD ./php.ini /usr/local/etc/php/php.ini

RUN wget https://getcomposer.org/installer -O - -q \
    | php -- --install-dir=/bin --filename=composer --quiet
RUN usermod -u 1000 www-data && groupmod -g 1000 www-data
WORKDIR /var/www
USER "1000:1000"
CMD ["php-fpm"]
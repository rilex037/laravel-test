FROM php:8.4-alpine

RUN apk update && apk add --no-cache \
    bash \
    git \
    curl \
    libpng-dev \
    libjpeg-turbo-dev \
    libwebp-dev \
    zlib-dev \
    libzip-dev \
    oniguruma-dev \
    postgresql-dev \
    && rm -rf /var/cache/apk/*

RUN docker-php-ext-install \
    pdo \
    pdo_mysql \
    pdo_pgsql \
    mbstring \
    exif \
    pcntl \
    bcmath \
    zip \
    && docker-php-ext-configure gd --with-jpeg --with-webp \
    && docker-php-ext-install gd

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN adduser -D -u 1000 php

COPY entrypoint.sh /home/php/entrypoint.sh
RUN chown php:php /home/php/entrypoint.sh \
    && chmod +x  /home/php/entrypoint.sh

USER php

WORKDIR /home/php/app

ENTRYPOINT ["/home/php/entrypoint.sh"]
CMD []
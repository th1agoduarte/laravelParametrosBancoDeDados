# Base Debian 12
FROM php:8.4-fpm

ARG user=app
ARG uid=1000
ARG gid=1000

ENV ACCEPT_EULA=Y
WORKDIR /var/www

# System deps
RUN apt-get update && apt-get install -y --no-install-recommends \
    git curl ca-certificates zip unzip \
    libzip-dev libicu-dev libxml2-dev \
    libpng-dev libjpeg62-turbo-dev libfreetype6-dev libwebp-dev \
    unixodbc-dev gnupg2 \
 && rm -rf /var/lib/apt/lists/*

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instalador de extensões
COPY --from=mlocati/php-extension-installer:latest /usr/bin/install-php-extensions /usr/bin/install-php-extensions

# Extensões PHP
RUN chmod +x /usr/bin/install-php-extensions \
 && install-php-extensions \
    bcmath exif gd intl opcache pcntl pdo_mysql zip redis

# (Opcional) Node 20 para Vite
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
 && apt-get update && apt-get install -y --no-install-recommends nodejs \
 && rm -rf /var/lib/apt/lists/*

# Grupo/usuário idempotente
RUN getent group ${gid} || groupadd -g ${gid} ${user} \
 && id -u ${uid} >/dev/null 2>&1 || useradd -l -m -u ${uid} -g ${gid} ${user} \
 && usermod -aG www-data ${user} \
 && chown -R ${user}:www-data /var/www

USER ${user}

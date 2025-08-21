# Base mais atual (Debian 12/bookworm). Evite buster (EOL).
FROM php:8.4-fpm

# Defaults para evitar falha se não passar ARG no build
ARG user=app
ARG uid=1000

# Ambiente e diretório
ENV ACCEPT_EULA=Y
WORKDIR /var/www

# Dependências de sistema (build + runtime)
RUN apt-get update && apt-get install -y --no-install-recommends \
    git curl ca-certificates \
    zip unzip \
    libzip-dev \
    libicu-dev \
    libxml2-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libwebp-dev \
    unixodbc-dev \
    gnupg2 \
 && rm -rf /var/lib/apt/lists/*

# (Opcional) Repositório MS SQL para sqlsrv/pdo_sqlsrv
# Use a lista do Debian 12 (bookworm)
#RUN curl -sSL https://packages.microsoft.com/keys/microsoft.asc | apt-key add - \
# && echo "deb [arch=amd64] https://packages.microsoft.com/config/debian/12/prod.list /" > /etc/apt/sources.list.d/mssql-release.list \
# && apt-get update \
# && ACCEPT_EULA=Y apt-get install -y --no-install-recommends msodbcsql18 mssql-tools18 \
# && rm -rf /var/lib/apt/lists/*

# Composer (multistage oficial)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instalador de extensões do PHP (mlocati)
COPY --from=mlocati/php-extension-installer:latest /usr/bin/install-php-extensions /usr/bin/install-php-extensions

# Extensões necessárias do Laravel + drivers
# (gd é configurado automaticamente pelo mlocati usando as libs já instaladas)
RUN chmod +x /usr/bin/install-php-extensions \
 && install-php-extensions \
    bcmath \
    exif \
    gd \
    intl \
    opcache \
    pcntl \
    pdo_mysql \
    zip \
    redis
#   sqlsrv pdo_sqlsrv \  # (Opcional) MS SQL

# (Opcional) Node.js 20 para Vite (build do front dentro do container)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
 && apt-get update && apt-get install -y --no-install-recommends nodejs \
 && rm -rf /var/lib/apt/lists/*

# Usuário sem privilégios (não quebre o FPM executando como root)
RUN groupadd -g ${uid} ${user} \
 && useradd -l -m -u ${uid} -g ${user} ${user} \
 && usermod -aG www-data ${user} \
 && chown -R ${user}:www-data /var/www

USER ${user}

# Dica: crie os diretórios de cache/log em runtime (entrypoint) ou no Dockerfile:
# RUN mkdir -p /var/www/storage /var/www/bootstrap/cache && chmod -R 775 /var/www/storage /var/www/bootstrap/cache

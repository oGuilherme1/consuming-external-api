FROM php:8.1-cli

# Instalando dependências comuns
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip \
    nano \
    libmcrypt-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev

# Instalando extensões PHP necessárias
RUN docker-php-ext-install mysqli pdo pdo_mysql gd mbstring xml

# Instalando extensão opcional pcntl
RUN docker-php-ext-configure pcntl --enable-pcntl \
    && docker-php-ext-install pcntl

# Instalando o Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Copiando o código-fonte do projeto para o contêiner
COPY . /var/www/html

# Definindo o diretório de trabalho
WORKDIR /var/www/html

# Instalando dependências do projeto e iniciando o servidor do laravel
CMD bash -c "composer install && php artisan serve --host 0.0.0.0"


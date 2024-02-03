FROM php:8.2-fpm

ARG user
ARG uid
WORKDIR /var/www/html

# Install Dependencies
RUN apt-get update && apt-get install -y nodejs npm git curl libpng-dev libonig-dev libxml2-dev zip unzip libxslt-dev libgcrypt-dev telnet
RUN apt-get install -y wget dpkg fontconfig libfreetype6 libjpeg62-turbo libxrender1 xfonts-75dpi xfonts-base mariadb-client
    
#install some base extensions
RUN apt-get install -y \
        libzip-dev \
        zip \
        zlib1g-dev\
  && docker-php-ext-install zip \
  && docker-php-ext-install xsl \
  && docker-php-ext-install gd

RUN pecl install redis

# Clear Cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql intl mbstring exif pcntl bcmath gd 

# Get latest Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install Supervisor and dependencies
RUN apt-get update && apt-get install -y supervisor

# Set Work Directory and Give Permission
RUN useradd -G root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && chown -R $user:$user /home/$user
RUN chown -R $user:$user /var/www/html

# USER $user
COPY . /var/www/html
RUN composer install
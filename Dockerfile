FROM php:8.2-fpm

ARG user
ARG uid

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

# Clear Cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql intl mbstring exif pcntl bcmath gd 

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

 RUN mkdir -p /var/www/Linker
 COPY ./ /var/www/Linker

# RUN ls -lrth /var/www/link/ && ls -l /var/www/link/storage
WORKDIR /var/www/Linker
RUN useradd -G root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && chown -R $user:$user /home/$use
RUN chown -R $user:$user /var/www/Linker
#RUN chmod -R 777 /var/www/link

USER $user

# Install packages
RUN composer install
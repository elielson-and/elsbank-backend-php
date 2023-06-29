
FROM php:8.2-fpm

# creating a user to container
ARG user=laravel
ARG uid=1000

# Installing linux dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# clearing cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Installing PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd sockets

# Getting latest versio  of composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Creating system user to run Composer and Artisan Commands as superuser.
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Setting working directory
WORKDIR /var/www

USER $user

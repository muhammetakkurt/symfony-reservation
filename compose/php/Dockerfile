FROM php:8.1-fpm-alpine

# Copy File Config
ADD ./compose/php/www.conf /usr/local/etc/php-fpm.d/www.conf

# ADD and set Group
RUN addgroup -g 1000 symfony && adduser -G symfony -g symfony -s /bin/sh -D symfony

# Create folder to run
RUN mkdir -p /var/www/html

# Set Profile
RUN chown symfony:symfony /var/www/html

# Work in the specific space
WORKDIR /var/www/html

# Install dependencies
RUN apk add --no-cache \
    freetype \
    libpng \
    libjpeg-turbo \
    freetype-dev \
    libpng-dev \
    libjpeg-turbo-dev

RUN docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg 

RUN NPROC=$(grep -c ^processor /proc/cpuinfo 2>/dev/null || 1) && \
    docker-php-ext-install -j${NPROC} gd 

RUN apk del --no-cache freetype-dev libpng-dev libjpeg-turbo-dev

RUN docker-php-ext-install pdo pdo_mysql
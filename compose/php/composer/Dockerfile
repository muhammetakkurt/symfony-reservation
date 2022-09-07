FROM composer:latest

# ADD and set Group
RUN addgroup -g 1000 symfony && adduser -G symfony -g symfony -s /bin/sh -D symfony

# Set Profile to All Files
RUN chown -R symfony:symfony /var/www/html

# Run in work space
WORKDIR /var/www/html
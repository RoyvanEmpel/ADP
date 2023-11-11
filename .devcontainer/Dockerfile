FROM php:8.2-cli

# Update package repository en installeer essentiële pakketten
RUN apt-get update && apt-get install -y \
        git \
        unzip

# Installeer Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

# Set memory limit higher
RUN echo 'memory_limit = 4G' >> /usr/local/etc/php/conf.d/docker-php-memlimit.ini

# Installeer afhankelijkheden
RUN composer require phpunit/phpunit

# Installeer afhankelijkheden
RUN composer install --no-scripts --no-autoloader

# Genereer de autoloader scripts
RUN composer dump-autoload --optimize
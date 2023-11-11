FROM php:8.2-cli

# Update package repository en installeer essentiële pakketten
RUN apt-get update && apt-get install -y \
        git \
        unzip

# Installeer Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/usr/local/bin --filename=composer \
    && php -r "unlink('composer-setup.php');"

# Kopieer composer.json en composer.lock
COPY ../composer.json ./
COPY ../composer.lock ./

# Installeer afhankelijkheden
RUN composer install --no-scripts --no-autoloader

# Kopieer de rest van de code
COPY . .

# Genereer de autoloader scripts
RUN composer dump-autoload --optimize

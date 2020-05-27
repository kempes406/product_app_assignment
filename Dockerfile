FROM php:7-apache

RUN apt-get update && \
    apt-get install -y \
        zlib1g-dev \
        git

# Copy application source
COPY . /var/www/prod_app/
RUN chown -R www-data:www-data /var/www/prod_app

# Install composer
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

EXPOSE 8080

WORKDIR /var/www/prod_app

CMD php -S 0.0.0.0:8080 -t public


FROM php:8.3-cli

WORKDIR /app

COPY . /app

RUN apt-get update && apt-get install -y unzip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer install

CMD ["tail", "-f", "/dev/null"]
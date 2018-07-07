FROM php:7.2-apache

RUN apt-get update
RUN apt-get install -y zlib1g-dev
RUN apt-get install -y vim
RUN apt-get install -y zip wget

RUN docker-php-ext-install zip
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-enable pdo pdo_mysql
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN a2enmod rewrite
RUN chmod -R 777 /etc/hosts
RUN sh -c "echo '127.0.0.1   afterwork.ovh sous.afterwork.photogram.ovh' >> /etc/hosts"
COPY ./Docker/000-default.conf /etc/apache2/sites-available/
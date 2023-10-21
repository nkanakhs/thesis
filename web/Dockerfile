FROM php:7.4.26-apache

RUN a2enmod rewrite

COPY . /var/www/html

#COPY apache_ssl.conf /etc/apache2/sites-available/000-default.conf

RUN apt-get update && apt-get install -y \
		libfreetype6-dev \
		libjpeg62-turbo-dev \
		libpng-dev \
    	libzip-dev \
	&& docker-php-ext-configure gd --with-freetype --with-jpeg \
	&& docker-php-ext-install -j$(nproc)  mysqli pdo pdo_mysql gd zip

COPY --from=composer/composer:latest-bin /composer /usr/bin/composer

RUN \ 
 apt-get update 


# Store PHP Configs at /usr/local/etc/php/conf.d
RUN echo "upload_max_filesize = 500M" >> /usr/local/etc/php/conf.d/upload_large_dumps.ini \
    && echo "post_max_size = 500M"       >> /usr/local/etc/php/conf.d/upload_large_dumps.ini \
    && echo "memory_limit = -1"           >> /usr/local/etc/php/conf.d/upload_large_dumps.ini \
    && echo "max_execution_time = 0"      >> /usr/local/etc/php/conf.d/upload_large_dumps.ini


RUN chmod 777 /var/www/html/docker-entrypoint.sh

CMD [ "/var/www/html/docker-entrypoint.sh" ]	
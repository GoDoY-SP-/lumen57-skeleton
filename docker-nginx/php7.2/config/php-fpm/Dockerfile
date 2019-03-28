FROM php:7.2-fpm

# Propriedade
MAINTAINER Danilo D. de Godoy <danilo.doring@gmail.com>

# Variaveis de Ambiente
ENV PHP_MODS=/usr/local/etc/php/conf.d

# Extensions
RUN apt-get update && apt-get install -y \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    zlib1g-dev \
    libpng-dev \
    libpq-dev \
    libssl-dev \
    libxml2-dev \
    libmemcached-dev \
    wget \
    git

RUN pecl install \
        mongodb \
        redis \
        xdebug-2.6.0 \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) \
        gd \
        iconv \
        bcmath \
        mysqli \
        pcntl \
        pdo_mysql \
        pdo_pgsql  \
        zip \
        sockets \
        soap \
    && docker-php-ext-enable \
        opcache \
        mongodb \
        redis \
        xdebug

# Composer
RUN php -r "readfile('https://getcomposer.org/installer');" > composer-setup.php \
    && php composer-setup.php \
    && php -r "unlink('composer-setup.php');" \
    && chmod +x composer.phar \
    && mv composer.phar /usr/bin/composer

# Add global composer bin dir to PATH
ENV PATH /root/.composer/vendor/bin:$PATH

# Configurar xDebug
RUN echo "xdebug.remote_enable=1" >> $PHP_MODS/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_autostart=1" >> $PHP_MODS/docker-php-ext-xdebug.ini \
    && echo "xdebug.remote_connect_back=1" >> $PHP_MODS/docker-php-ext-xdebug.ini \
    && echo "xdebug.idekey = 'xDOCKERx'" >> $PHP_MODS/docker-php-ext-xdebug.ini

# Install phpcs, phpcbf and phpcdp
RUN DEBIAN_FRONTEND=noninteractive && curl -L https://squizlabs.github.io/PHP_CodeSniffer/phpcs.phar -o /usr/local/bin/phpcs \
    && chmod 755 /usr/local/bin/phpcs \
    && curl -L https://squizlabs.github.io/PHP_CodeSniffer/phpcbf.phar -o /usr/local/bin/phpcbf \
    && chmod 755 /usr/local/bin/phpcbf \
    && curl -L https://phar.phpunit.de/phpcpd.phar -o /usr/local/bin/phpcdp \
    && chmod 755 /usr/local/bin/phpcdp

WORKDIR "/var/www/lumen57"
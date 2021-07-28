FROM php:7.4.2-fpm-buster 

ENV ACCEPT_EULA=Y

# Microsoft SQL Server Prerequisites
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        libonig-dev \
        locales \
        apt-transport-https \
        git \
        gnupg \ 
        libzip-dev \ 
        libxml2-dev \ 
        libmemcached-dev \
        libpq-dev \
        busybox \
        postgresql \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && curl https://packages.microsoft.com/keys/microsoft.asc | apt-key add - \
    && curl https://packages.microsoft.com/config/debian/10/prod.list \
        > /etc/apt/sources.list.d/mssql-release.list \
    && echo "en_US.UTF-8 UTF-8" > /etc/locale.gen \
    && locale-gen \
    && apt-get update \
    && apt-get -y --no-install-recommends install \
        unixodbc-dev \
        msodbcsql17

RUN docker-php-ext-install mbstring pgsql pdo pdo_mysql pdo_pgsql mysqli sockets zip xmlrpc sysvsem soap\
    && pecl install redis memcached \
    && pear install XML_RPC2 \
    && git clone --depth=1 -b NON_BLOCKING_IO_php7 https://github.com/websupport-sk/pecl-memcache.git /tmp/php-memcache \
    && cd /tmp/php-memcache \
    && phpize && ./configure  && make && make install \
    && cd .. && rm -rf /tmp/php-memcache/ \
    && echo 'extension=memcache.so' >>  /usr/local/etc/php/conf.d/memcache.ini \
    && docker-php-ext-enable memcached redis

ADD php.ini /usr/local/etc/php/conf.d/40-custom.ini
WORKDIR /var/www
CMD ["php-fpm"]
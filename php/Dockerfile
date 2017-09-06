FROM php:5.6-apache

EXPOSE 80

# debian packages
RUN apt-get update && apt-get install -y \
    htop \
    wget \
    lynx \
    curl \
    tree \
    mc \
    vim \
    libmcrypt-dev \
    libicu-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng12-dev \
    libxml2-dev \
    mysql-client \
    unzip \
    git

# php modules
RUN docker-php-ext-install -j$(nproc) \
    mysqli \
    pdo \
    pdo_mysql \
    mbstring \
    mysql \
    iconv \
    mcrypt \
    intl \
    opcache \
    xml \
    soap \
    opcache \
    opcache \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd

# php xdebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# php composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# php ioncube
RUN curl -SL http://downloads3.ioncube.com/loader_downloads/ioncube_loaders_lin_x86-64.tar.gz | tar xzv --directory /tmp --strip-components=1 \
    && mv /tmp/ioncube_loader_lin_5.6.so /usr/local/lib/php/extensions/no-debug-non-zts-20131226/

# php config
COPY conf.d/00-ioncube.ini /usr/local/etc/php/conf.d/
COPY conf.d/99-custom.ini /usr/local/etc/php/conf.d/

# apache modules
RUN a2enmod rewrite

# cleanup
RUN apt-get clean \
    && rm -fr /tmp/*

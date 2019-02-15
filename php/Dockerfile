FROM php:5.6-apache

ENV DEBIAN_FRONTEND=noninteractive

EXPOSE 80

# debian packages
RUN apt-get update && apt-get install -y --no-install-recommends \
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
    libpng-dev \
    libxml2-dev \
    mysql-client \
    unzip \
    git \
    locales \
    tzdata \
    graphicsmagick \
    imagemagick \
    libmagickwand-dev

# locales
RUN printf 'en_GB.UTF-8 UTF-8\n' >> /etc/locale.gen \
    && printf 'en_US.UTF-8 UTF-8\n' >> /etc/locale.gen \
    && printf 'de_DE.UTF-8 UTF-8\n' >> /etc/locale.gen \
    && locale-gen

ENV LANGUAGE=de_DE.UTF-8
ENV LC_ALL=de_DE.UTF-8
ENV LC_CTYPE=UTF-8
ENV LANG=de_DE.UTF-8

# localtime
ENV TZ='Europe/Berlin'
RUN echo $TZ > /etc/timezone \
    && rm /etc/localtime \
    && ln -snf /usr/share/zoneinfo/$TZ /etc/localtime \
    && dpkg-reconfigure -f noninteractive tzdata

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
    zip \
    exif \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd

# php pecl modules
RUN pecl install xdebug-2.5.5 imagick \
    && docker-php-ext-enable xdebug imagick

# php composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# php ioncube
RUN curl -SL http://downloads3.ioncube.com/loader_downloads/ioncube_loaders_lin_x86-64.tar.gz | tar xzv --directory /tmp --strip-components=1 \
    && mv /tmp/ioncube_loader_lin_5.6.so /usr/local/lib/php/extensions/no-debug-non-zts-20131226/

# apache modules
RUN a2enmod rewrite

# apache rights
RUN usermod -o -u 1000 www-data

# imagemagick
RUN ln -s /usr/lib/x86_64-linux-gnu/ImageMagick-6.8.9/bin-Q16/MagickWand-config /usr/bin/

# cleanup
RUN apt-get clean \
    && rm -fr /var/lib/apt/lists/* \
    && rm -fr /tmp/* \
    && rm -fr /var/tmp/*

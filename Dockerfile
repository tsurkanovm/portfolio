FROM kindratmakc/docker-symfony3

RUN yes | pecl install xdebug \
    && echo "zend_extension=$(find /usr/lib/php/20160303/ -name xdebug.so)" > /etc/php/7.1/fpm/conf.d/20-xdebug.ini \
    && echo "xdebug.remote_enable=on" >> /etc/php/7.1/fpm/conf.d/20-xdebug.ini \
    && echo "xdebug.remote_autostart=off" >> /etc/php/7.1/fpm/conf.d/20-xdebug.ini

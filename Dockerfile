FROM lisotton/focoradical-php:8.1

ADD ./ /var/www/
ADD ./config/php/php.ini /usr/local/etc/php/conf.d/focoradical.ini
ADD ./config/apache/virtualhost.conf /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www

EXPOSE 80

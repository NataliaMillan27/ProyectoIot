FROM php:8.3-apache

RUN apt-get update && apt-get install -y \
    default-mysql-server \
    supervisor \
    && docker-php-ext-install mysqli

COPY recibir_datos.php /var/www/html/recibir_datos.php
COPY dashboard.php /var/www/html/dashboard.php
COPY init.sql /init.sql
COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

EXPOSE 80

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
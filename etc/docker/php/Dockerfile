FROM php:7.1-fpm

RUN usermod -u 1000 www-data
RUN chsh -s /bin/bash www-data
RUN chown -R www-data:www-data /var/www/html

#ENTRYPOINT ["entrypoint.sh"]

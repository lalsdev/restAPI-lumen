FROM composer
RUN composer global require "laravel/lumen-installer"
RUN composer install
ENV PATH $PATH:/tmp/vendor/bin
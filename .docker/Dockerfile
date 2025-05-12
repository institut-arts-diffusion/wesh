FROM composer:2.7 AS vendor
WORKDIR /var/www/html

COPY composer.json .
COPY composer.lock .
RUN composer install --no-dev --no-scripts --ignore-platform-reqs --prefer-dist --no-interaction --no-plugins

COPY . .

RUN mkdir -p /var/www/html/storage && \
    mkdir -p /var/www/html/resources && \
    mkdir -p /var/www/html/bootstrap/cache && \
    mkdir -p /var/www/html/storage/logs && \
    mkdir -p /var/www/html/storage/framework/cache && \
    mkdir -p /var/www/html/storage/framework/sessions && \
    mkdir -p /var/www/html/storage/framework/views && \
    mkdir -p /var/www/html/storage/app/public && \
    mkdir -p /var/www/html/storage/app/livewire-tmp

RUN composer dumpautoload --optimize --ignore-platform-reqs

FROM php:8.4-cli
WORKDIR /var/www/html

COPY --from=vendor /var/www/html /var/www/html
RUN touch /var/www/html/database/database.sqlite
RUN php artisan migrate && php artisan storage:link && php artisan optimize

# Configure non-root user.
ARG UNAME=www-data
ARG UGROUP=www-data
ARG UID=1000
ARG GID=1001
RUN usermod  --uid $UID $UNAME
RUN groupmod --gid $GID $UGROUP

RUN chown www-data:www-data  -R /var/www/html/storage && \
    chown www-data:www-data  -R /var/www/html/bootstrap/cache && \
    chown www-data:www-data  -R /var/www/html/resources

ENTRYPOINT ["php", "/var/www/html/artisan", "serve", "--host=0.0.0.0", "--port=8000"]

EXPOSE 8000

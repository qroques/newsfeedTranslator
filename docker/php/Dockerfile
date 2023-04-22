FROM php:8.1-fpm as base

RUN docker-php-ext-install pdo_mysql

RUN pecl install apcu

RUN apt-get update && \
    apt-get install -y \
    libzip-dev

RUN docker-php-ext-install zip
RUN docker-php-ext-enable apcu

WORKDIR /usr/src/app

RUN PATH=$PATH:/usr/src/app/vendor/bin:bin

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

FROM base as php-scheduler

# hadolint ignore=DL3002
USER root
RUN apt-get update && \
    apt-get upgrade -y && \
    apt-get install -y cron && \
    apt-get clean && \
    rm -r /var/lib/apt/lists/*

COPY docker/scheduler/config/entrypoint.sh /usr/local/bin/entrypoint.sh
COPY docker/scheduler/config/crontab /etc/crontab

RUN chmod 0600 /etc/crontab && crontab /etc/crontab

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
CMD ["cron","-f", "-l", "2"]

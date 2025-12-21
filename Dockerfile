FROM trafex/php-nginx

USER root

# Установи SQLite3 для Alpine Linux
RUN apk add --no-cache \
    sqlite \
    sqlite-dev \
    php84-sqlite3 \
    php84-pdo_sqlite

RUN chown -R nobody:nobody /var/www/html

USER nobody

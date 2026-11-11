# PHP Docker-стенд

nginx, PHP 8.5 (FPM), Composer, Postgres 18, Redis 8, Memcached 1.6.
nginx и PHP-FPM соединены через unix-сокет (`docker/php/zz-socket.conf`, volume `php_socket`).

## Запуск

```bash
cp .env.example .env
docker compose up -d --build
make composer c="install"
```

Открыть http://localhost:8080: проверки подключения к Postgres, Redis, Memcached, Composer и phpinfo().

## Composer

Пакеты ставятся от твоего пользователя (иначе файлы будут принадлежать root):

```bash
make composer c="require vendor/package"
```

Нужен `make` (`sudo apt install make`).
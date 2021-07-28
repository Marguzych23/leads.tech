# leads.tech

Для запуска скрипта из контейнера выполните следующие команды:
1) сборка контейнера `docker-compose build`
2) запуск `docker-compose up -d`
3) перейти в командную строку контейнера php - `docker exec -ti php bash`
4) переходим в директорию проекта `cd /var/www/apps/client-order-processing-system`
5) подгрузка зависимостей `composer install`
6) запуск скрипта `php /var/www/apps/client-order-processing-system/shell/run_generator.php`
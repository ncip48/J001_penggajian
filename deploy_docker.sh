docker-compose build app
docker-compose up -d
docker-compose exec app docker-php-ext-install pdo pdo_mysql mbstring

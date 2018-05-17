# afterWork2

Installation
docker-compose build
docker-compose up -d

docker exec -it symfonyApp bash
composer update

bin/console doctrine:database:create --if-not-exists
bin/console doctrine:schema:update --force

Local Environment
Symfony url : photogram.com:8080
Mysql url: localhost:3306 
Db : afterwork 
PhpMyAdmin url : 
http://localhost:8090 
Login : root Password : root

App URL : http://localhost:8080/


Symfony command
Mise à jour de la Database
php bin/console doctrine:migrations:diff
php bin/console doctrine:migrations:migrate

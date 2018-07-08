# afterWork2

Afterwork est un projet qui permet de géré des évenements.Etant un etudiant j'aimerai cree une communauté autour des ce projet.Je vous invite a fork et m'aider a la realisation de cette application web.

### Lien Serveur de Prod

http://after-tech.fr/

### Prerequis
```
Docker
```

## Installation

```
docker-compose build


docker-compose up -d

docker exec -it symfonyApp bash 

composer update

bin/console doctrine:database:create --if-not-exists

bin/console doctrine:schema:update --force


```

### Local Environment


- App URL : http://localhost:8080/
- Mysql url: http://localhost:3306 
- Db : afterwork 
- DATABASE_URL=mysql://root:root@symfonyDb:3306/afterwork

### PhpMyAdmin 
- URL : http://localhost:8090 
- Login : root 
- Password : root


### Symfony command

Mise à jour de la Database
```
php bin/console doctrine:migrations:diff
php bin/console doctrine:migrations:migrate

```

ce rajouter le role admin

```
bin/console fos:user:promote <votrenomutilisateur> ROLE_ADMIN
```


### Lien Serveur de Prod

http://after-tech.fr/

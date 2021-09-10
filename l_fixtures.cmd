@echo off
symfony console doctrine:database:drop --force || true
symfony console doctrine:database:create
symfony console doctrine:migrations:migrate -n
symfony console doctrine:fixtures:load -n

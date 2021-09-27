@echo off
set APP_ENV=test
symfony console doctrine:database:drop --force || true
symfony console doctrine:database:create
symfony console doctrine:migrations:migrate -n
@REM symfony console doctrine:fixtures:load -n
symfony php bin/phpunit

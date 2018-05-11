## Install necessary dependency

composer install && npm install

## Copy example env file and change database credentials accordingly

cp .env.example .env

## Generate the application key

php artisan key:generate


##Migrate the database 

php artisan migrate


## So ..
Enjoy!

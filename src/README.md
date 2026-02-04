## step 1. install package
cmd:\
composer install

## step 2. config infomation in .env file
DB_CONNECTION=mysql\
DB_HOST=127.0.0.1\
DB_PORT=3306\
DB_DATABASE=<your db name>\
DB_USERNAME=<your un>\
DB_PASSWORD=<your pw>\
note: remove a character '#'

## step 3. creating tables of database
cmd:\
php artisan migrate

## step 4. inserting default values into tables
cmd:\
php artisan db:seed

## for testing
makesure you have .env.testing file, and copy a real database for production paste new database for tesing\
cmd:\
php artisan test --env=testing

## for deployment
open 2 cmd\
cmd 1:\
php artisan serve\
cmd 2:\
npm install\
npm run dev
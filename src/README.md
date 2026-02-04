## step 1. install package
```bash
composer install
```

## step 2. config infomation in .env file
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=<your db name>
DB_USERNAME=<your un>
DB_PASSWORD=<your pw>
```
- note: remove a character '#'

## step 3. creating tables of database
```bash
php artisan migrate
```

## step 4. inserting default values into tables
```bash
php artisan db:seed
```
## step 5. generate key
```bash
php artisan key:generate
```

## for testing
- makesure you have .env.testing file, and copy a real database for production paste new database for tesing
```bash
php artisan test --env=testing
```

## for deployment
- open 2 cmd
- cmd 1
```bash
php artisan serve
```
- cmd 2
```bash
npm install
npm run dev
```

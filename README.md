## Initial steps
```shell
docker compose up -d
docker-compose exec php-fpm bash
```

## Database connection
1. Run `php artisan migrate`
2. Connect to database by following credentials:
```dotenv
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=12345678
```
3. Import csv files from the folder `./sqldump` one by one, keeping the the order

## Connection with Adalo
As the project was not deployed to any server and was connected to Adalo through ngrock, bellow is an instruction to run ngrock:
1. Create ngrock account (https://dashboard.ngrok.com/signup)
2. Copy auth token from following page: https://dashboard.ngrok.com/get-started/your-authtoken
3. Run following command, replacing \<AUTHTOKEN> with copied one
```shell
docker run --net=host -it -e NGROK_AUTHTOKEN=<AUTHTOKEN> ngrok/ngrok:latest http 8087
```

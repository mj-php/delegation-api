## Starting App

1. Run `composer install`
2. Run `npm install`
3. Run `cp .env.example .env`
4. Run `docker compose build --pull --no-cache` to build fresh images
5. Run `./vendor/bin/sail up -d` to run images
6. Run `./vendor/bin/sail artisan migrate:fresh --seed` to run fresh migrations and seeders

# Api

1. Postman Collection is provided in project root *Delegations Api.postman_collection.json*

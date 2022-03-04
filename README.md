# Laravel Scaffolding
The laravel scaffolding of our projects.

> This project using laravel 9.x if you still using laravel 8.x you should checkout to `8.x` branch by running `git checkout 8.x` command. 

## Deploying To Local Server
If you use valet just execute the `init.sh` file to configure your environment automatically.
```bash
git clone https://github.com/laravel-modules/scaffolding.git my-app
cd my-app
bash ./init.sh
```
Otherwise, you should configure your environment manually by the following steps:

- Clone the project to your local server using the following command:
    ```bash
    git clone https://github.com/laravel-modules/scaffolding.git my-app
    ```

- Go to the project path and configure your environment:
    - Copy the `.env.example` file to `.env`:
        ```bash
        cd ./project
    
        cp .env.example .env
        ```
    - Configure database in your `.env` file:
        ```dotenv
        DB_DATABASE=project
        DB_USERNAME=root
        DB_PASSWORD=
        ```
    - Install composer packages using the following command:
        ```bash
        composer install
        ```
    - Generate the project key using the following artisan command:
        ```bash
        php artisan key:generate
        ```
    - Migrate the database tables and dummy data:
        ```bash
        php artisan migrate --seed
        ```
    - Run the project in your browser using `artisan serve` command:
        ```bash
        php artisan serve
        ```
- Go to your browser and visit: [http://localhost:8000](http://localhost:8000)
## Deploying Using Docker Container
```shell
cp .env.example .env
docker-compose run --rm artisan key:generate
docker-compose run --rm artisan storage:link --force
docker-compose run --rm artisan migrate --seed
docker-compose up # turn on all services...
```
- To access the project go to your browser and visit: [http://localhost:8080](http://localhost:8080)
- To access phpmyadmin go to your browser and visit: [http://localhost:8088](http://localhost:8088)
- To access mailhog go to your browser and visit: [http://0.0.0.0:8025](http://0.0.0.0:8025)

- Default Admin  Credentials:
    - **Email:** admin@demo.com
    - **Password:** password
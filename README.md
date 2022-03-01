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
- First you should make sure that the docker is installed in your machine then run the following command:
    ```shell
    docker-compose up --build
    ```
  > This will take a few minutes in the first time
  
  > note: add the `--build` flag only in the first time.
  > and you can add `-d` to run container in background.
  
  > Any change in `.env` file you should restart the container
  
- You can set the app port from `.env` file in `APP_PORT` variable.
- To access the project go to your browser and visit: [http://localhost:5000](http://localhost:5000)
- To access phpmyadmin go to your browser and visit: [http://localhost:5050](http://localhost:5050)
- To access mailhog go to your browser and visit: [http://0.0.0.0:8025](http://0.0.0.0:8025)

- Default Admin  Credentials:
    - **Email:** admin@demo.com
    - **Password:** password
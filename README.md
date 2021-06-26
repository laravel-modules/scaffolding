# Laravel Scaffolding
The laravel scaffolding of our projects.

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
        > After migrating press `Y` to seed dummy data.
    - Run the project in your browser using `artisan serve` command:
        ```bash
        php artisan serve
        ```
    - Go to your browser and visit: [http://localhost:8000](http://localhost:8000)
        - Default Admin  Credentials:
            - **Email:** admin@demo.com
            - **Password:** password
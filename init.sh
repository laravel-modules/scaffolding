#!/bin/bash
# Initialize the project's environment.

# Set the project's name from directory.
PROJECT_NAME=$(basename $(pwd))

# Let user write his domain and the database's username & password.
read -p "Enter the APP_DOMAIN: [$PROJECT_NAME.test]" APP_DOMAIN
read -p "Enter the DB_USERNAME: [root]" DB_USERNAME
read -sp "Enter the DB_PASSWORD: " DB_PASSWORD
DB_USERNAME=${DB_USERNAME:-root}
APP_DOMAIN=${APP_DOMAIN:-$PROJECT_NAME.test}

echo -e "\n"

# Create the mysql database.
mysql -u root --password=$DB_PASSWORD -e "create database $PROJECT_NAME CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci"

# Create the project's .env file.
sed -e "s|DB_DATABASE=laravel|DB_DATABASE=$PROJECT_NAME|"\
    -e "s|DB_USERNAME=root|DB_USERNAME=$DB_USERNAME|"\
    -e "s|DB_PASSWORD=|DB_PASSWORD=$DB_PASSWORD|"\
    -e "s|APP_DOMAIN=localhost|APP_DOMAIN=$APP_DOMAIN|" ./.env.example > ./.env

# Install dependencies.
composer install

# Generate the app key.
php artisan key:generate

# Create symlink for storage and media files.
php artisan storage:link

# Migrate the tables and seed accounts and dummy data.
php artisan migrate:fresh --seed

# Print the project's URL.
echo APP_URL: http://$PROJECT_NAME.test
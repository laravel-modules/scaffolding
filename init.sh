#!/bin/bash
# Initialize the project's environment.

# Set the project's name from directory.
PROJECT_NAME=$(basename $(pwd))

ask_question(){
    # ask_question <question> <default>
    local ANSWER
    read -r -p "$1 ($2): " ANSWER
    echo "${ANSWER:-$2}"
}

ask_secure_question(){
    # ask_secure_question <question> <default>
    local ANSWER
    if [ $2 ]; then
        read -r -sp "$1 ($2): " ANSWER
        else
        read -r -sp "$1: " ANSWER
    fi
    echo "${ANSWER:-$2}"
}
# Let user write the app domain and the database name, username and password.
APP_URL=$(ask_question "Enter App Url" "http://$PROJECT_NAME.test")
DB_DATABASE=$(ask_question "Enter The Database Name" "$PROJECT_NAME")
DB_USERNAME=$(ask_question "Enter The Database Username" "root")
DB_PASSWORD=$(ask_secure_question "Enter The Database Password" "")
echo " "

# Create the mysql database.
mysql -u root --password=$DB_PASSWORD -e "create database $DB_DATABASE CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci"

# Create the project's .env file.
sed -e "s|DB_DATABASE=laravel|DB_DATABASE=$DB_DATABASE|"\
    -e "s|DB_USERNAME=root|DB_USERNAME=$DB_USERNAME|"\
    -e "s|DB_PASSWORD=|DB_PASSWORD=$DB_PASSWORD|"\
    -e "s|APP_URL=http://localhost|APP_URL=$APP_URL|" ./.env.example > ./.env

# Install dependencies.
composer install

# Generate the app key.
php artisan key:generate

# Create symlink for storage and media files.
php artisan storage:link

# Migrate the tables and seed accounts and dummy data.
php artisan migrate:fresh --seed

# Print the project's URL.
echo APP_URL: $APP_URL
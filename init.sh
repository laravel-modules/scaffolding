#!/bin/bash
# Initialize the project's environment.

set -e  # Exit immediately if any command fails.

PROJECT_NAME=$(basename "$(pwd)")

ask_question(){
    local ANSWER
    read -r -p "$1 ($2): " ANSWER
    echo "${ANSWER:-$2}"
}

ask_secure_question(){
    local ANSWER
    if [ "$2" ]; then
        read -r -sp "$1 ($2): " ANSWER
    else
        read -r -sp "$1: " ANSWER
    fi
    echo "${ANSWER:-$2}"
}

# Ask user for environment details
APP_NAME=$(ask_question "Enter App Name" "$PROJECT_NAME")
APP_URL=$(ask_question "Enter App Url" "http://$PROJECT_NAME.test")
DB_DATABASE=$(ask_question "Enter The Database Name" "${PROJECT_NAME//[-\.]/_}")
DB_USERNAME=$(ask_question "Enter The Database Username" "root")
DB_PASSWORD=$(ask_secure_question "Enter The Database Password" "")
echo " "
SESSION_DRIVER=$(ask_question "Enter Session Driver" "database")
CACHE_STORE=$(ask_question "Enter Cache Store" "database")
QUEUE_CONNECTION=$(ask_question "Enter Queue Connection" "sync")
PHP=$(ask_question "Enter PHP Version (binary name)" "php")
COMPOSER_CMD="$PHP $(which composer)"

# Create database if not exists
mysql -u"$DB_USERNAME" --password="$DB_PASSWORD" \
  -e "CREATE DATABASE IF NOT EXISTS \`$DB_DATABASE\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci"

# Copy .env.example to .env
cp .env.example .env

# Uncomment and configure .env values
sed -i -E '
  s|^#[[:space:]]*(DB_HOST=)|\1|;
  s|^#[[:space:]]*(DB_PORT=)|\1|;
  s|^#[[:space:]]*(DB_DATABASE=)|\1|;
  s|^#[[:space:]]*(DB_USERNAME=)|\1|;
  s|^#[[:space:]]*(DB_PASSWORD=)|\1|;
  s|^#[[:space:]]*(SESSION_DRIVER=)|\1|;
' .env

# Force DB_CONNECTION to mysql
sed -i -E "s|^DB_CONNECTION=.*|DB_CONNECTION=mysql|" .env

# Apply user-provided values
sed -i -E "s|^APP_NAME=.*|APP_NAME=\"$APP_NAME\"|" .env
sed -i -E "s|^APP_URL=.*|APP_URL=$APP_URL|" .env
sed -i -E "s|^DB_HOST=.*|DB_HOST=127.0.0.1|" .env
sed -i -E "s|^DB_DATABASE=.*|DB_DATABASE=$DB_DATABASE|" .env
sed -i -E "s|^DB_USERNAME=.*|DB_USERNAME=$DB_USERNAME|" .env
sed -i -E "s|^DB_PASSWORD=.*|DB_PASSWORD=$DB_PASSWORD|" .env
sed -i -E "s|^SESSION_DRIVER=.*|SESSION_DRIVER=$SESSION_DRIVER|" .env
sed -i -E "s|^CACHE_STORE=.*|CACHE_STORE=$CACHE_STORE|" .env
sed -i -E "s|^QUEUE_CONNECTION=.*|QUEUE_CONNECTION=$QUEUE_CONNECTION|" .env

# Install dependencies & run Laravel setup
$COMPOSER_CMD install
$PHP artisan key:generate
$PHP artisan storage:link --force
$PHP artisan migrate:fresh --seed

echo "APP_URL: $APP_URL"

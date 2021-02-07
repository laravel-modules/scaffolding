#!/bin/bash

# Install phpmyadmin in laravel application.

if [[ -d ./vendor/pma ]]
then
    rm -rf ./vendor/pma
fi

mkdir ./vendor/pma

wget -O ./vendor/pma/pma.zip https://www.phpmyadmin.net/downloads/phpMyAdmin-latest-all-languages.zip

unzip ./vendor/pma/pma.zip -d ./vendor/pma

rm ./vendor/pma/pma.zip

PMA_DIR=$(ls ./vendor/pma/)

mv ./vendor/pma/$PMA_DIR/* ./vendor/pma/

rm -rf ./vendor/pma/$PMA_DIR

random_blowfish_secret=$(openssl rand -base64 32)
sed -e "s|cfg\['blowfish_secret'\] = ''|cfg['blowfish_secret'] = '$random_blowfish_secret'|" ./vendor/pma/config.sample.inc.php > ./vendor/pma/config.inc.php

base_path=$(pwd)

ln -s $base_path/vendor/pma $base_path/public/pma

echo phpMyAdmin linked to = /public/pma

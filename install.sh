#!/bin/bash

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

clone_project() {
  echo "Installing the $PROJECT_NAME project ..."

  git clone https://github.com/laravel-modules/scaffolding.git $PROJECT_NAME
}

# Let user write the app name, domain and the database name, username and password.
PROJECT_NAME=$(ask_question "Enter App Name" "my-app")

echo " "

if [ -d "$PROJECT_NAME" ]; then
    echo "The project with name '$PROJECT_NAME' already exists."

    echo "Do you want to override it? (y/n)"
    read override_option

    if [ "$override_option" == "y" ]; then
        echo "Removing the existing folder..."
        rm -rf $PROJECT_NAME

        clone_project
    fi
else
  clone_project
fi

cd ./$PROJECT_NAME

git remote remove origin

bash ./init.sh

echo "cd ./$PROJECT_NAME"

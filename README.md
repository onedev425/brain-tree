# Braintree Learning

## Requirements
* Php 8.1 and above
* Composer 
* Laravel version 9
* Npm

## Installation
* Install composer dependancies
```shell
composer install
```
* Copy .env.example file into .env file and configure based on your environment
```shell
cp .env.example .env
```
* Install node dependencies
```shell
cp  npm install
```
* Build NPM assets
```shell
  npm run build
```

Note if you do not have node, you can do this in your local environment and using an ftp program upload the publi/build folder and manifest.json folder to your server
* Generate encryption key
```shell
php artisan key:generate
```
* Migrate the database
```shell
php artisan migrate
```
* Seed database 
    
    You can seed the database in 2 ways
    - For production ie in your live server
        ```shell
        php artisan db:seed --class RunInProductionSeeder
        ```
    - For testing or development purposes
        ```shell
        php artisan db:seed
        ```
* Seed database to populate countries (takes approximately 10 minutes)
```shell
php artisan db:seed --class=WorldSeeder
```
* Set application logo by adding it in the public img folder and edit the .env logo path appropriately
* Store favicon in path public/favicons/, the file should be called favicon.ico
* For development or testing purposes, you can use the laravel built in server by running 
```shell
php artisan serve
```

## Setup
* Log in to the application with the following credentials
    * Email: super@admin.com
    * Password: password

* You would be prompted to change your password, change your passsword in the profile page to continue

# braintree-main

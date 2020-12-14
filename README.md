# MBTI Test ( Larave + Vue.js example project )
This repository contains source code for simple MBTI test.

## Tech stack
- Backend: PHP7, Laravel, MySQL
- Frontend: Vue.js (material design)

## Prerequisite
- You have to install docker on your app
## Installation
First, you may have to create .env file. Copy the file ".env.example" as ".env"

Start server by docker
```
$ docker-compose up -d
```

And then install composer packages, migrate and seed database.
In docker shell, run the following commands.
```
$ composer install
...
$ php artisan migrate
$ php artisan db:seed
```

That's all. Your mbti test service started.

## Test
If you want to test, you have to create database named as "shift_test" like this. It can be configured in .env.testing.
And then, please run the following command in docker shell.
```
php ./vendor/phpunit/phpunit/phpunit
```

## User story
Please go to the landing page. With the default configuration, your server url is http://localhost:8011/
As the page load, the questions are unfolded. All you need to do is the select the answer for each questions, input your email, and finally submit.

Then, you will be redirected to result page.

## Technical User story
Users can login with their email and see their test results. Login url is http://localhost:8011/login
There will be the lists you have tried. You can select the item and the left side, you answer will be appeared.

# Intructions

## 1.1 - Copy env.example to .env file and set missing variables
## 1.2 - Run this command bellow to install dependencies ( you need to have docker on your machine)
    >  docker run --rm --interactive --tty --volume $PWD:/app composer install

## 1.3 - Run this command bellowto  start the server
    >  ./vendor/bin/sail up -d

## 1.4 - Run this command bellow to install node dependencies
    >  ./vendor/bin/sail npm i

## 1.5 - Run this command bellow to build
    >  ./vendor/bin/sail npm run build

## You can see the results acessing this URL

> http://localhost

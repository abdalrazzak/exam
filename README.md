 
 

## requirements
* php  ^7.3|^8.0
* laravel ^7.29
* mysql 5.7.35
* Apache server

## Installation 
### Execute the following command
> composer update
### Adjust .env settings 
 >  - DB_CONNECTION=mysql
 >  - DB_HOST=127.0.0.1
 >  - DB_PORT=3306
 >  - DB_DATABASE=test
 >  - DB_USERNAME=test
 >  - DB_PASSWORD=test
 >  ## queue with database
 >  - QUEUE_CONNECTION=database
## Execute the following command with database test
>  php artisan migrate:fresh --seed

API endpoint 
| Method | Endpoint | Format Reqest
| ----------- | ----------- | ----------- |
| POST | /api/v1/register |   {  "name" : "abd" ,    "email" : "xFPeMa22H01Sww@gmail.com" ,  "password" : "password" , "appID" : 1 , "expire_date" : "2021-12-01" }|
| Paragraph | Text 

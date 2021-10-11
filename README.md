 
 

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

##API Endpoint 
<table>
<tr>
<td> Method </td> <td> Endpoint </td><td> Request </td>
</tr>
<tr>
<td> POST </td>
<td> /api/v1/register </td>
<td>

  
{
 
        "name" : "abd" ,
        "email" : "xFPeMa22H01Sww@gmail.com" ,
        "password" : "password" ,
        "appID" : 1 , 
        "expire_date" : "Y-m-d" 
 
}
 

</td> 
</tr>
<tr>
<td> POST </td>
<td> /api/v1/login </td>
<td>

  
{
 
        "email" : "xFPeMa22H01Sww@gmail.com" ,
        "password" : "password" ,
        "appID" : 1  , 
        "deviceID" :  1012
 
}
 

</td>
    
</tr>
    
<tr>
<td> POST </td>
<td> /api/v1/payment </td>
<td>
 body
 { 
     
        "receipt_string" : "43232fdse3" ,
        "appID" : "1" 

}
    
header 
{  
      "Bearer" : token   
}
 

</td>
    
</tr>
    
<tr>
<td> GET </td>
<td> /api/v1/report </td>
<td>

  
{
    "from" : "Y-m-d" , // expire date  from
    "to" : "Y-m-d"     // expire date  to
} 

</td>
    
</tr>
 
</table>

## WORKER
### To check expired subscriptions and send notifications to users . 
open termianl with SSH and trigger command  . 
> php artisan queue:work 
and 
> php artisan subscription:check 
or you can trigger everyday with cron job from server .

# Testing  
For development you can run the following command . 
> ./vendor/bin/phpunit


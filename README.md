laravel-twitter-facebook-oauth
==============================

twitter and facebook authorization for laravel 4

**Instructions:**<br>
1) Run ```composer install``` to get required vendors<br>
2) change database configs and run ```php artisan migrate```<br>
3) create a virtual host<br>
3.1) ```127.0.0.1 laravel.dev``` to your hosts file<br>
3.2) add the following lines to your apache httpd-vhosts.conf file <br>
```
<VirtualHost *:80>
    DocumentRoot "path-to-local-installation\public"
    ServerName www.laravel.dev
</VirtualHost>
```
4) Login with Facebook or Twitter

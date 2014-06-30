laravel-twitter-facebook-oauth
==============================

twitter and facebook authorization for laravel 4

Instructions:

1) Run "composer install" to get required vendors\n
2) change database configs and run "php artisan migrate"\n
3) create a virtual host\n
3.1) "127.0.0.1 laravel.dev" to your hosts file\n
3.2) add the following lines to your apache httpd-vhosts.conf file \n
<VirtualHost *:80>\n
    DocumentRoot "path-to-local-installation\public"\n
    ServerName www.laravel.dev\n
</VirtualHost>\n
\n
4) Login with Facebook or Twitter\n

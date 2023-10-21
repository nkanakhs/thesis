#!/bin/bash
/usr/bin/composer install --working-dir=/var/www/html/
a2enmod ssl
a2ensite default-ssl.conf
apache2-foreground 
# service apache2 reload
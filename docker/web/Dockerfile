# HELP
# <https://blog.silarhi.fr/image-docker-php-apache-parfaite/>
# Distro
FROM php:8.0-apache

# Expose port
EXPOSE 80 443

# Creation des dossiers
RUN mkdir --parents /etc/pocketinnocity/certs/ && \
# Desactivation des conf
a2dissite 000-default && \
a2dissite default-ssl && \
# Suppression des conf garbage
rm /etc/apache2/sites-available/*.conf

# COPY
## Conf apache
COPY sites-available/pocketinnocity.conf /etc/apache2/sites-available/pocketinnocity.conf
## Certificats HTTPS
COPY certs /etc/pocketinnocity/certs
## Website
COPY index.php /var/www/html/index.php

# Activation de la conf
RUN a2ensite pocketinnocity && \
# Activation du ssl
a2enmod ssl
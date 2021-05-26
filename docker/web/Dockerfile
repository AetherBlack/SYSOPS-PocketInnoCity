# Docker image
FROM php:8.0-apache

# Expose port
EXPOSE 80 443

# Non interactive apt
ENV DEBIAN_FRONTEND noninteractive

# Creation des dossiers
RUN mkdir --parents /etc/pocketinnocity/certs/ && \
# Desactivation des configurations de base
a2dissite 000-default && \
a2dissite default-ssl && \
# Suppression des configurations de base
rm /etc/apache2/sites-available/*.conf && \
# Mise à jour des packets
apt update && \
# Installation de modsecurity
apt install --no-install-recommends --yes libapache2-mod-security2 && \
# Suppression du cache APT
rm -rf /var/lib/apt/lists/* && \
# Activation du ssl
a2enmod ssl

# COPY
## Configuration apache
COPY sites-available/pocketinnocity.conf /etc/apache2/sites-available/pocketinnocity.conf
## Configuration PHP
COPY php/php.ini /usr/local/etc/php/php.ini
## Configuration modsecurity in apache
COPY conf-available/security.conf /etc/apache2/conf-available/security.conf
## Certificats HTTPS
COPY certs /etc/pocketinnocity/certs
## Modsecurity
COPY modsecurity /etc/modsecurity
## Website
COPY index.php /var/www/html/index.php

# Activation de la configuration
RUN a2ensite pocketinnocity && \
# Reload or start apache2
/etc/init.d/apache2 reload || /etc/init.d/apache2 start
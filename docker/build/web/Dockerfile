# Docker image
FROM php:8.0-apache

# Docker arguments
ARG PATH_TO_SYMFONY_BINARY=/root/.symfony/bin/symfony
ARG PATH_TO_COMPOSER_INSTALLER=/tmp/composer_installer

# Non interactive APT
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
apt install -qq -y libapache2-mod-security2 && \
# Suppression du cache APT
rm -rf /var/lib/apt/lists/* && \
# Activation du ssl
a2enmod ssl

# COPY
## Configuration apache
COPY ./app/sites-available/pocketinnocity.conf /etc/apache2/sites-available/pocketinnocity.conf
## Configuration PHP
COPY ./app/php/php.ini /usr/local/etc/php/php.ini
## Configuration modsecurity in apache
COPY ./app/conf-available/security.conf /etc/apache2/conf-available/security.conf
## Certificats HTTPS
COPY ./app/certs /etc/pocketinnocity/certs
## Modsecurity
COPY ./app/modsecurity /etc/modsecurity
## Website
COPY ./app/www /var/www/html/
## Symfony binary
COPY ./app/symfony_installer /tmp/symfony_installer
## Composer installation
COPY ./app/composer_installer ${PATH_TO_COMPOSER_INSTALLER}
COPY ./app/composer-setup.php /tmp/composer-setup.php

# Activation de la configuration
RUN a2ensite pocketinnocity && \
# Reload or start apache2
/etc/init.d/apache2 reload || /etc/init.d/apache2 start && \
# Installation de symfony
bash /tmp/symfony_installer && \
# Installation de composer
bash ${PATH_TO_COMPOSER_INSTALLER} && \
# Changement du cwd
cd /var/www/html && \
# Installation des dépendances
composer install && \
# Migrations doctrine
${PATH_TO_SYMFONY_BINARY} console doctrine:migrations:migrate && \
# Dummy data
${PATH_TO_SYMFONY_BINARY} console doctrine:fixtures:load && \
# Lancement du serveur web par Symfony
symfony serve -d
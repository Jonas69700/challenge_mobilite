FROM richarvey/nginx-php-fpm:1.7.2

# Définir les variables d’environnement
ENV WEBROOT /var/www/html/public
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV COMPOSER_ALLOW_SUPERUSER=1

# Copier le code dans le conteneur
COPY . /var/www/html

# Installer les extensions PHP nécessaires
RUN docker-php-ext-install pdo_pgsql bcmath

# Installer Composer si pas déjà fourni
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Installer les dépendances
WORKDIR /var/www/html
RUN composer install --optimize-autoloader --no-interaction --no-dev

# Donner les bonnes permissions à Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

CMD ["/start.sh"]
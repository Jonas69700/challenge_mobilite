# Utilise l'image officielle PHP avec FPM
FROM php:8.4-fpm

# Installe les dépendances système nécessaires
RUN apt-get update && apt-get install -y \
    zip unzip curl git libzip-dev libpng-dev libonig-dev libxml2-dev \
    libicu-dev libpq-dev libjpeg-dev libfreetype6-dev libjpeg62-turbo-dev \
    && docker-php-ext-install pdo pdo_mysql zip bcmath gd

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir le dossier de travail
WORKDIR /var/www/html

# Copier les fichiers du projet
COPY . .

# Donner les bons droits à Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expose le port FPM
EXPOSE 9000

CMD ["php-fpm"]
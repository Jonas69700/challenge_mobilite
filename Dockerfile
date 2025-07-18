# Utilise l'image PHP 8.2 avec FPM
FROM php:8.2-fpm

# Installer les paquets système et les extensions PHP requises
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    unzip \
    git \
  && docker-php-ext-install \
    pdo \
    pdo_mysql \
    zip \
    bcmath \
  && rm -rf /var/lib/apt/lists/*

# Copier Composer depuis l'image officielle
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /app

# Copier les fichiers de l’application
COPY . .

# Installer les dépendances PHP et JS, puis compiler les assets
RUN composer install --no-dev --optimize-autoloader --no-interaction \
  && npm ci \
  && npm run production

# Mettre les bons droits sur storage et cache
RUN chown -R www-data:www-data storage bootstrap/cache

# Exposer le port FPM
EXPOSE 9000

# Commande de démarrage
CMD ["php-fpm"]

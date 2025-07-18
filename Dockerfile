# Utilise une image PHP avec les extensions requises
FROM php:8.2-cli

# Installe les extensions requises (dont bcmath)
RUN apt-get update && apt-get install -y \
    git unzip zip libzip-dev \
    && docker-php-ext-install pdo pdo_mysql bcmath zip

# Installe Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Crée et définit le dossier de travail
WORKDIR /var/www/html

# Copie tous les fichiers du projet
COPY . .

# Installe les dépendances
RUN composer install --optimize-autoloader --no-interaction --no-dev

# Rends le script start.sh exécutable
RUN chmod +x start.sh

# Port exposé pour Laravel
EXPOSE 8000

# Commande de démarrage
CMD ["./start.sh"]

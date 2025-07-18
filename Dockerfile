FROM richarvey/nginx-php-fpm:1.7.2

# Copier tous les fichiers du projet
COPY . /var/www/html

# Définir le dossier racine du site
ENV WEBROOT /var/www/html/public

# Ne pas exécuter composer automatiquement si on gère ça ailleurs
ENV SKIP_COMPOSER 1

# Laravel config
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV LOG_CHANNEL=stderr

# Autoriser composer en root (utile dans ce conteneur)
ENV COMPOSER_ALLOW_SUPERUSER 1

# Exécuter les scripts init (start.sh inclus par l'image de base)
ENV RUN_SCRIPTS 1

# PHP affiche les erreurs sur STDERR (log Render)
ENV PHP_ERRORS_STDERR 1

# Configuration Nginx : utile si tu es derrière un proxy
ENV REAL_IP_HEADER 1

# Dossier de travail
WORKDIR /var/www/html

# Installer les dépendances PHP
RUN composer install --optimize-autoloader --no-interaction --no-dev

# Permissions (optionnel selon tes erreurs)
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache \
    && chown -R www-data:www-data /var/www/html

# Commande de démarrage
CMD ["/start.sh"]

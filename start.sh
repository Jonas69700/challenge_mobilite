#!/bin/bash

# Attendre que la base de données soit prête (optionnel mais utile)
sleep 5

# Lancer les migrations et les seeders
php artisan migrate --force
php artisan db:seed --force

# Lancer le serveur Laravel
php artisan serve --host=0.0.0.0 --port=${PORT:-8000}

FROM php:8.2-cli

# Installe bcmath (et autres extensions Laravel courantes)
RUN apt-get update \
    && apt-get install -y unzip git libzip-dev libpng-dev libonig-dev libxml2-dev zip curl \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Installe Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /app
COPY . .

# Installe Node.js pour npm/vite
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

RUN composer install --no-dev --optimize-autoloader
RUN npm install && npm run build

# Port Railway
EXPOSE 8080

CMD [ "php", "artisan", "serve", "--host=0.0.0.0", "--port=8080" ]
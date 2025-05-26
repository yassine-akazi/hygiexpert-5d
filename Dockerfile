# Étape 1 : Utiliser l'image PHP officielle avec extensions nécessaires
FROM php:8.2-fpm

# Installer les dépendances système et extensions PHP requises pour Laravel
RUN apt-get update && apt-get install -y \
    git unzip zip libzip-dev libpng-dev libonig-dev libxml2-dev curl \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath xml gd

# Installer Composer globalement
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copier tout le code dans le container
WORKDIR /var/www/html
COPY . .

# Installer les dépendances PHP via Composer
RUN composer install --no-dev --optimize-autoloader

# Donner les droits au dossier storage et bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Exposer le port 8000 (serveur Laravel)
EXPOSE 8000

# Lancer le serveur intégré Laravel (pas idéal en prod mais OK pour test)
CMD php artisan serve --host=0.0.0.0 --port=8000
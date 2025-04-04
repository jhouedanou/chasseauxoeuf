FROM php:8.1-apache

# Installation des dépendances système
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    nodejs \
    npm

# Installer les extensions PHP nécessaires
RUN docker-php-ext-install mbstring exif pcntl bcmath gd

# Activer le module rewrite d'Apache
RUN a2enmod rewrite

# Installer Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Définir le répertoire de travail
WORKDIR /var/www/html

# Copier les fichiers du projet
COPY . .

# Installer les dépendances PHP
RUN composer install --no-interaction --no-dev

# Installer les dépendances Node.js
RUN npm install --production

# Définir les variables d'environnement pour Supabase
ENV SUPABASE_URL="https://nbqssxhroavedcnjloys.supabase.co" \
    SUPABASE_KEY="eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6Im5icXNzeGhyb2F2ZWRjbmpsb3lzIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MzIyODgzNzcsImV4cCI6MjA0Nzg2NDM3N30.nlYK3l6l4wDqeWEEMknBSsBzlt0bLlFLGkFkbaluZj0"

# Configurer les permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Configurer le VirtualHost Apache pour le projet
RUN echo '<VirtualHost *:80>\n\
    DocumentRoot /var/www/html\n\
    <Directory /var/www/html>\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

# Exposer le port 80
EXPOSE 80

# Démarrer Apache
CMD ["apache2-foreground"]

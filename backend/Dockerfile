# Utilisation d'une image PHP.
FROM php:8.1-apache

# Copie du fichier de configuration Apache.
COPY .docker/apache/000-default.conf /etc/apache2/sites-available/

# Copie du code source de l'application.
COPY ./ /var/www/html

# Installation de bibliothèques/logiciels.
RUN apt-get update \
    && apt-get install -y \
    libxml2-dev \
    libonig-dev \
    libzip-dev \
    git \
    zsh \
    unzip

# Installation extensions PDO pour MySQL et ZIP.
RUN docker-php-ext-install dom xml mbstring pdo_mysql zip

# Installation de Composer.
RUN curl -sS https://getcomposer.org/installer \
    | php -- --install-dir=/usr/local/bin --filename=composer \
    && chmod +x /usr/local/bin/composer

# Installation de Oh My Zsh.
RUN sh -c "$(curl -fsSL https://raw.github.com/ohmyzsh/ohmyzsh/master/tools/install.sh)"

# Création d'un alias pour PHP Artisan.
RUN echo 'alias @="php artisan"' >> ~/.zshrc

# Activation de la réécriture d'URL pour Apache.
RUN a2enmod rewrite

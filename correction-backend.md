# Parcours : Back-end (Laravel) - Correction

## Création du projet

```bash
composer create-project laravel/laravel backend
```

Cette commande permet de créer un projet Laravel dans un dossier `backend` en installant toutes les dépendances nécessaires.

## Configuration du projet avec Docker

### Vérification et modification des variables d'environnement

On commence par copier le fichier `.env.example` en `.env` :

```bash
cp .env.example .env
```

On va utiliser une base de données au sein d'un environnement de développement sur Docker.  
On modifie quelques variables dans le fichier `.env` :

```bash
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=estimates
DB_USERNAME=student
DB_PASSWORD=secret
```

### Création de l'environnement de développement via Docker

On aura besoin au sein de différents conteneurs :
- Un conteneur dédié à notre API, avec :
    - Apache, afin de disposer d'un serveur pour notre API, qui gèrera les requêtes HTTP.
    - PHP, afin de pouvoir exécuter notre code PHP.
- MySQL, afin de disposer d'une base de données.
- Adminer, afin de disposer d'une interface graphique pour notre base de données.

### Création du fichier de configuration Apache

On va créer un fichier de configuration Apache, qui sera utilisé par notre conteneur.

On crée le fichier [`.docker/apache/000-default.conf`](./backend/.docker/apache/000-default.conf) au sein de notre projet :

```apache
<VirtualHost *:80>
    DocumentRoot /var/www/html/public
    ErrorLog ${APACHE_LOG_DIR}/error.log
    CustomLog ${APACHE_LOG_DIR}/access.log combined
</VirtualHost>
```

Celui-ci permet de définir le dossier `public` comme dossier racine de notre application Laravel.

### Création du Dockerfile

On va créer un fichier `Dockerfile` au sein de notre projet. Celui-ci va utiliser l'image `php:8.1-apache` et installer les dépendances nécessaires à notre application Laravel.

Le fichier [`Dockerfile`](./backend/Dockerfile) est commenté afin d'expliquer chaque étape :

```dockerfile
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
```

On utilise les variables d'environnement `GIT_USERNAME` et `GIT_EMAIL` afin de configurer Git au sein du conteneur. Celles-ci sont à définir dans le fichier `.env`.

### Création du fichier docker-compose.yml

On va créer un fichier `docker-compose.yml` au sein de notre projet. Celui-ci va permettre de créer les différents conteneurs nécessaires à notre application.

Le fichier [`docker-compose.yml`](./backend/docker-compose.yml) est commenté afin d'expliquer chaque étape :

```yaml
version: "3.8"
services:
  api:
    build: .
    depends_on:
      - mysql
    ports:
      - "8090:80"
      - "8005:8000"
    volumes:
      - .:/var/www/html
  mysql:
    image: mysql:8.0
    ports:
      - "4306:3306"
    environment:
      - MYSQL_DATABASE=${DB_DATABASE}
      - MYSQL_USER=${DB_USERNAME}
      - MYSQL_PASSWORD=${DB_PASSWORD}
      - MYSQL_ROOT_PASSWORD=root
  adminer:
    image: adminer:4.8.1
    depends_on:
      - mysql
    ports:
      - "8085:8080"
```

Les ports ont été définis afin d'éviter les conflits avec une éventuelle installation de MySQL ou d'Apache sur la machine hôte.

On peut lancer l'environnement de développement via la commande suivante :

```bash
docker-compose up -d --build
```

---

L'application Laravel devrait être disponible à l'adresse [http://localhost:8090](http://localhost:8090) ou l'adresse de votre machine (sur le bon port).

> Si vous êtes sur Windows ou Mac et que vous avez une erreur 404 en utilisant l'environnement Docker, essayez d'utiliser un autre navigateur. Il est probable que Firefox, notamment, rencontre des soucis.

### Accès au conteneur de l'API

On peut accéder au conteneur de l'API via la commande suivante :

```bash
docker-compose exec api zsh
```

Cela permet de lancer des commandes directement au sein du conteneur. On va lancer les commandes suivantes :

```bash
composer install
chmod -R o+w storage .env
```

#### Utilisation de l'alias `@`

Au sein du conteneur, l'alias `@` permet d'utiliser la commande `php artisan` plus facilement. Par exemple :

```bash
@ optimize # php artisan optimize
```

Cette commande permet d'optimiser l'application Laravel, en générant des fichiers de cache.

### Accès à la base de données

On peut accéder à la base de données via l'interface Adminer, disponible à l'adresse [http://localhost:8085](http://localhost:8085) ou l'adresse de votre machine (sur le bon port).

Les identifiants sont les suivants :
- Serveur : `mysql`
- Base de données : `estimates`
- Utilisateur : `student`
- Mot de passe : `secret`

## Création des modèles, des migrations, des contrôleurs, des *factories* et des *seeders*

On va créer les modèles, les migrations, les contrôleurs, les *factories* et les *seeders* nécessaires à l'application, en minimisant le nombre de commandes à lancer.

Pour cela, on va utiliser la commande `php artisan make:model` avec des options :
- `--api` pour créer un contrôleur de type API.
- `-m` pour créer une migration.
- `-c` pour créer un contrôleur.
- `-f` pour créer une *factory*.
- `-s` pour créer un *seeder*.

D'autres options sont disponibles.

Cela donne, par exemple, la commande suivante :

```bash
@ make:model Estimate -m --api
```

Voici le résultat de cette commande :

```
INFO  Model [app/Models/Estimate.php] created successfully.

INFO  Migration [database/migrations/2023_07_04_152332_create_estimates_table.php] created successfully.  

INFO  Controller [app/Http/Controllers/EstimateController.php] created successfully.  
```

Il est possible de mixer les options, selon les besoins.

```bash
@ make:model Estimate -m --api
@ make:model EstimateField -mf --api
@ make:model EstimateFieldValue -m
@ make:model EstimateLine -m
```

Cela va générer 4 modèles, 4 migrations, 2 contrôleurs et 1 *factory*.

### (Bonus) Création des relations

On va éditer les modèles afin de créer les relations entre les différents modèles.

Une estimation a plusieurs lignes. On va donc ajouter la relation `hasMany` au modèle `Estimate` :

```php
public function lines(): HasMany
{
    return $this->hasMany(EstimateLine::class);
}
```

De même, on va ajouter la relation `belongsTo` au modèle `EstimateLine` :

```php
public function estimate(): BelongsTo
{
    return $this->belongsTo(Estimate::class);
}
```

Un champ pour l'estimation peut avoir plusieurs valeurs. On va donc ajouter la relation `hasMany` au modèle `EstimateField` :

```php
public function values(): HasMany
{
    return $this->hasMany(EstimateFieldValue::class);
}
```

De même, on va ajouter la relation `belongsTo` au modèle `EstimateFieldValue` :

```php
public function field(): BelongsTo
{
    return $this->belongsTo(EstimateField::class);
}
```

### Création des routes

On utilise `apiResource` afin de créer les routes pour les contrôleurs de type API.

```php
Route::apiResources([
    "estimates" => EstimateController::class,
    "fields" => EstimateFieldController::class
]);
```

Cela permet d'automatiquement générer l'ensemble des routes nécessaires à l'API pour le CRUD.

### Edition des méthodes des contrôleurs

Les contrôleurs générés contiennent déjà les méthodes `index`, `store`, `show`, `update` et `destroy`. On va les éditer afin de retourner une réponse en JSON, avec le nom de la page.

Par exemple, voici l'ensemble des méthodes du contrôleur `EstimateController` :

```php
<?php

namespace App\Http\Controllers;

use App\Models\Estimate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EstimateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return response()->json(["name" => "GET /api/estimates : Liste des estimations."]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        return response()->json(["name" => "POST /api/estimates : Création d'une estimation."]);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id): JsonResponse
    {
        return response()->json(["name" => "GET /api/estimates/{estimate} : Affichage d'une estimation."]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id): JsonResponse
    {
        return response()->json(["name" => "PUT|PATCH /api/estimates/{estimate} : Mise à jour d'une estimation."]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): JsonResponse
    {
        return response()->json(["name" => "DELETE /api/estimates/{estimate} : Suppression d'une estimation."]);
    }
}
```

On fait la même chose pour le contrôleur `EstimateFieldController`.

### Initialisation de la base de données

#### Modification des migrations

Avant de créer les *seeders*, on va modifier les migrations afin d'avoir des tables correspondant au besoin.

On va ici montrer seulement quelques exemples. Les autres migrations sont à faire de la même manière, en n'oubliant pas d'implémenter aussi la méthode `down()`.

On va modifier la migration `create_estimates_table` afin d'ajouter les champs `name` et `total_time` :

```php
public function up()
{
    Schema::create('estimates', function (Blueprint $table) {
        $table->id();
        $table->string('name')->default('');
        $table->integer('total_time')->default(0);
        $table->timestamps();
    });
}
```

On va modifier la migration `create_estimate_lines_table` afin d'ajouter les champs `name`, `slug`, et `type` :

```php
public function up()
{
    Schema::create('estimate_lines', function (Blueprint $table) {
        $table->id();
        $table->string('label');
        $table->integer('time');
        $table->string('type')->default('general');
        $table->timestamps();

        $table->foreignId('estimate_id')->constrained()->cascadeOnDelete();
    });
}
```

#### Création des *seeders*

Plutôt que de créer un *seeder* par modèle, on va modifier le *seeder* principal qui va créer les données nécessaires à l'application.

On va donc modifier le fichier `DatabaseSeeder.php` :

```php
<?php

namespace Database\Seeders;

use App\Models\EstimateField;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        EstimateField::factory()->create([
            "name" => "Nom du projet",
            "slug" => Str::slug("Nom du projet"),
            "type" => "text"
        ]);

        EstimateField::factory()->create([
            "name" => "Technologies",
            "slug" => Str::slug("Technologies"),
            "type" => "select"
        ])
            ->values()->createMany([
                [
                    "label" => "Laravel",
                    "value" => "laravel",
                    "startup_time" => 4 * 60,
                    "total_percentage" => 0
                ],
                [
                    "label" => "Laravel et Vue.js",
                    "value" => Str::slug("Laravel et Vue.js"),
                    "startup_time" => 6 * 60,
                    "total_percentage" => 25
                ]
            ]);

        EstimateField::factory()->create([
            "name" => "Développements génériques",
            "slug" => Str::slug("Développements génériques"),
            "type" => "checkbox"
        ])
            ->values()->createMany([
                [
                    "label" => "Page d'accueil",
                    "value" => Str::slug("Page d'accueil"),
                    "time" => 7 * 60,
                ],
                [
                    "label" => "Événement",
                    "value" => Str::slug("Événement"),
                    "time" => 14 * 60,
                ],
                [
                    "label" => "Page de type éditoriale",
                    "value" => Str::slug("Page de type éditoriale"),
                    "time" => 5 * 60,
                ],
                [
                    "label" => "Offres d'emplois",
                    "value" => Str::slug("Offres d'emplois"),
                    "time" => 16 * 60,
                ],
                [
                    "label" => "Blog",
                    "value" => Str::slug("Blog"),
                    "time" => 10 * 60,
                ],
            ]);

        EstimateField::factory()->create([
            "name" => "Développements supplémentaires",
            "slug" => Str::slug("Développements supplémentaires"),
            "type" => "custom"
        ]);

        EstimateField::factory()->create([
            "name" => "Type de design",
            "slug" => Str::slug("Type de design"),
            "type" => "select"
        ])
            ->values()->createMany([
                [
                    "label" => "Simple",
                    "value" => Str::slug("Simple"),
                    "total_percentage" => 0,
                ],
                [
                    "label" => "Complexe",
                    "value" => Str::slug("Complexe"),
                    "total_percentage" => 15,
                ],
                [
                    "label" => "Complexe avec animations",
                    "value" => Str::slug("Complexe avec animations"),
                    "total_percentage" => 20,
                ]
            ]);
    }
}
```

Cela permet de générer des champs pour les estimations et des valeurs pour les champs de type sélecteur ou case à cocher.

#### Lancement des migrations et des *seeders*

Afin de lancer les migrations et les *seeders*, on va utiliser la commande suivante :

```bash
@ migrate:fresh --seed
```

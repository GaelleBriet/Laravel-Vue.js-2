# Atelier : Back-end (Laravel) et front-end (Vue.js)

Si tu lis ce message, c'est que tu as décidé de repartir d'un répertoire tout frais tout beau pour te lancer à l’assaut de l'atelier.

Mais attention, il va te falloir procéder à quelques étapes avant de pouvoir travailler !

## Initialisation du back-end

Pense à lire le fichier `correction-backend.md` pour avoir des informations sur la correction du parcours, avec notamment les détails de l'environnement de développement utilisé avec Docker.

L'important à savoir est que l'environnement peut être lancé avec la commande suivante :

```bash
docker-compose up -d --build
```

On peut accéder au conteneur de l'API via la commande suivante :

```bash
docker-compose exec api zsh
```

Cela permet de lancer des commandes directement au sein du conteneur. On va lancer les commandes suivantes :

```bash
composer install
chmod -R o+w storage .env
```

L'ensemble des commandes, notamment celles liées à Laravel, peuvent être lancées directement au sein du conteneur.

L'alias `@` permet de lancer les commandes PHP Artisan. Par exemple, pour lancer les migrations, on peut utiliser la commande suivante :

```bash
@ migrate:fresh --seed
```

## Initialisation du front-end

Rends-toi dans le répertoire dédié et lance l'installation des dépendances.

```bash
cd frontend
npm install
```

À ce stade, tu devrais pouvoir lancer ton application Vue sans soucis avec Vite.

```bash
npm run dev
```

# Atelier : Back-end (Laravel) et front-end (Vue.js)

## Initialisation du back-end

```bash
cd backend
```

L'environnement peut être lancé avec la commande suivante :

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

Changer la constante de l'ApiService.js dans src/services/ApiServices.js.

En modifiant évidament "prenomnom" par ton prenom et ton nom.

Sinon rien ne sera chargé étant donné que les call Api ne vont mener null part et donc rien retourner.

```
const BASE_URL = "http://prenomnom-server.eddi.cloud:8090";
```

À ce stade, tu devrais pouvoir lancer ton application Vue sans soucis avec Vite.

```bash
npm run dev
```

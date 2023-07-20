# Parcours : Front-end (Vue.js) - Correction

## Création du projet

```bash
npm create vue@latest
```

Cette commande permet de créer un projet Vue.js.

```
√ Project name: ... frontend
√ Add TypeScript? ... No
√ Add JSX Support? ... No
√ Add Vue Router for Single Page Application development? ... Yes
√ Add Pinia for state management? ... Yes
√ Add Vitest for Unit Testing? ... No
√ Add an End-to-End Testing Solution? » No
√ Add ESLint for code quality? ... Yes
√ Add Prettier for code formatting? ... Yes
```

Si l'on souhaite utiliser VueX, on peut répondre `No` à la question `Add Pinia for state management?`. On pourra, dès lors, installer la version désirée de VueX via NPM.

On peut ensuite lancer les commandes suivantes :

```bash
cd frontend
npm install
```

Cela permet d'installer les dépendances du projet. Le serveur de développement peut être lancé via la commande suivante :

```bash
npm run dev
```

L'application devrait être disponible à l'adresse [http://localhost:5173](http://localhost:5173) ou à l'adresse de votre machine sur le bon port.

## Nettoyage du projet

### ESLint et Prettier

On peut, à tout moment, lancer la commande suivante pour corriger automatiquement les erreurs de code :

```bash
npm run lint
```

Cela utilise ESLint.

On peut aussi utiliser Prettier pour formater automatiquement le code. La configuration de Prettier est disponible dans le fichier `.prettierrc.json`. On peut lancer la commande suivante pour formater automatiquement le code :

```bash
npm run format
```

### Suppression des composants et vues non utilisés

Afin de partir d'une base propre, on va nettoyer le projet. Au sein du dossier `src`, on va supprimer l'ensemble des fichiers dans le dossier `components` et `views`. On va également laisser le simple minimum dans le fichier `App.vue`.

```vue
<script>
</script>

<template>
  <h1>Racine de l'application: App.vue</h1>
</template>

<style scoped>
</style>
```

On peut garder `<script setup></script>` si on souhaite utiliser Composition API.

### Mise à jour des feuilles de style

On va remplacer le contenu du fichier `src/assets/base.css` par celui de notre feuille de style (`style.css`), disponible dans au sein de nos fichiers d'intégration. On va ajouter, par la même occasion la feuille de style `reset.css` disponible dans le même dossier. Enfin, on va modifier le fichier `src/assets/main.css` pour importer `base.css` et `reset.css`.

```css
@import './reset.css';
@import './base.css';
```

### Modification du *router* et du *store*

On va modifier le fichier `src/router/index.js` pour supprimer les routes...

```js
import { createRouter, createWebHistory } from 'vue-router'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: []
})

export default router
```

... et supprimer le fichier `src/store/counter.js`.

## Création des composants et des pages

### Création des pages

#### Création des pages vides

Pour rappel, l'application se compose de 3 pages :
- La page d'accueil (doit contenir le formulaire d'estimation de temps).
- La page de listant les estimations.
- La page de détails d'une estimation (servira pour le résultat après calcul et aussi pour le détail des estimations déjà effectuées). 

On va ajouter une page dédiée à la gestion des erreurs 404.

On va créer les fichiers suivants dans le dossier `src/views` :
- `EstimateForm.vue`
- `EstimateList.vue`
- `EstimateDetails.vue`
- `NotFound.vue`

<details><summary>Page: <code>EstimateForm</code> (Options API)</summary>

```vue
<script>
import { defineComponent } from "vue";

export default defineComponent({
  name: "EstimateForm"
});
</script>

<template>
  <h1>Page d'accueil : EstimateForm.vue</h1>
</template>

<style scoped>
</style>
```

</details>

<details><summary>Page: <code>EstimateForm</code> (Composition API) </summary>

```vue
<script setup>

</script>

<template>
  <h1>Page d'accueil : EstimateForm.vue</h1>
</template>

<style scoped>

</style>
```

</details>

Chaque composant aura la même structure de base.

#### Intégration du code HTML (en dur)

On va modifier le contenu des balises `<template></template>` de chaque composant pour y ajouter le code HTML de la page correspondante.

Le code de la page `EstimateList`, par exemple, correspond au contenu du fichier `estimation-list.html` disponible au sein des fichiers d'intégration.

- `EstimateForm` : `index.html`
- `EstimateList` : `estimation-list.html`
- `EstimateDetails` : `result.html`
- `NotFound` : `404.html`

Cela permet, déjà, d'avoir un aperçu du code HTML de chaque page, et celui qui pourra être réutilisé au sein de composant et/ou dynamisé

### Création des composants

#### Création du composant `BaseLayout`

On constate que chaque page a le même *layout* avec notamment un *header* commun. On va donc utiliser un composant dédié pour le *layout*, global à l'application.

On va créer le fichier `src/components/BaseLayout.vue` avec le contenu suivant :

```vue
<template>
  <header class="main-header">
    <span class="site-name">Estimato'r</span>
    <nav class="main-nav">
      <ul>
        <li>
          <a href=".#"> Calculato'r </a>
        </li>
        <li>
          <a href="#"> Dernières estimations </a>
        </li>
      </ul>
    </nav>
  </header>
  <main class="main-content">
    <slot></slot>
  </main>
  <footer>
  </footer>
</template>
```

On utilise un *slot* pour pouvoir insérer le contenu de la page dans le *layout*. On a aussi ajouté un *footer* vide, pour d'éventuelles modifications futures.

On va conserver, pour chacune des pages précédemment créer, uniquement le contenu de la balise `<main></main>`.

Pour la page d'erreur, contenant une classe en plus au sein de la balise `<main></main>`, on va créer une balise `<div></div>` avec la classe `page-error`.

```vue
<template>
  <div class="page-error">
    <h1 class="error-title">404</h1>
    <p class="error-description">La page demandée n'a pas été trouvé.</p>
  </div>
</template>
```

#### Création des composants dédiés au formulaire

On dispose aussi de plusieurs composants qui pourront être utilisé au sein du formulaire d'estimation. On note notamment, la répétition de sélecteur (`<select></select>`), ou de cases à cocher (`<input type="checkbox" />`).

On va créer les composants pour les différents types de champs du formulaire :
- `SelectInput.vue`
- `CheckboxInput.vue`
- `TextInput.vue`

Pour cela, on va créer un dossier `src/components/Input` et y ajouter les fichiers précédents. On va aussi créer un composant pour les développements spécifiques : `CustomTaskInput.vue`.

> On a choisi de nommer le dossier `Input`, plutôt que `inputs`. Les deux syntaxes sont valables. On a choisi la première afin de faire référence à la partie commune des noms des composants.

Pour le moment, on va laisser ces composants vides.

##### (Bonus) Création d'un fichier `index.js` pour les composants `Input`

On va créer un fichier `index.js` au sein du dossier `src/components/Input` et y ajouter le contenu suivant :

```js
import SelectInput from "./SelectInput.vue";
import CheckboxInput from "./CheckboxInput.vue";
import TextInput from "./TextInput.vue";
import CustomTaskInput from "./CustomTaskInput.vue";

export { SelectInput, CheckboxInput, TextInput, CustomTaskInput };
```

Cela nous permettra d'importer les composants de la manière suivante :

```js
import { SelectInput, CheckboxInput, TextInput, CustomTaskInput } from "@/components/Input";
```

#### Création des composants dédiés à l'affichage des estimations

Au sein de la page listant les estimations, on a une liste, répétant le même code HTML pour chaque estimation. On va donc créer un composant dédié à l'affichage d'une estimation : `EstimateCard.vue`. On peut aussi créer un composant parent pour la liste des estimations : `EstimateCardList.vue`.

Ces deux composants sont créés dans le dossier `src/components/EstimateCard`.

---

Il serait possible de créer davantage de composants, notamment pour le tableau affichant les détails d'une estimation, mais on va se contenter de ces composants pour le moment. On laisse le soin aux apprentis développeurs de créer les composants supplémentaires qu'ils jugeront utiles.

## Affichage de la page d'accueil

On va laisser le soin aux apprentis développeurs de créer les routes et les liens pour afficher les différentes pages. Pour le moment, on se contente, dans `src/App.vue`, d'afficher la page d'accueil.

<details><summary><code>App.vue</code> (Options API)</summary>

```vue
<script>
import { defineComponent } from "vue";

import BaseLayout from "@/components/BaseLayout.vue";
import EstimateForm from "@/views/EstimateForm.vue";

export default defineComponent({
  components: { EstimateForm, BaseLayout }
});
</script>

<template>
  <BaseLayout>
    <EstimateForm />
  </BaseLayout>
</template>

<style scoped></style>
```

</details>

<details><summary><code>App.vue</code> (Composition API)</summary>

```vue
<script setup>
import BaseLayout from "@/components/BaseLayout.vue";
import EstimateForm from "@/views/EstimateForm.vue";
</script>

<template>
  <BaseLayout>
    <EstimateForm />
  </BaseLayout>
</template>

<style scoped></style>
```

</details>

## (Optionnel) Et Docker dans tout ça ?

On ne l'a pas mis dans cette correction directement, mais voici un exemple de comment "Dockeriser" l'application côté front-end.

Tout d'abord, on pourrait utiliser une image de Node.js, en version légère avec Alpine, pour écrire un `Dockerfile`.

```Dockerfile
# Use the official Node.js image as the base.
FROM node:alpine3.18

# Set the working directory inside the container.
WORKDIR /app

# Copy the package.json and package-lock.json files to the working directory.
COPY package*.json ./

# Install dependencies.
RUN npm install

# Copy the rest of the app's source code.
COPY ./ ./

# Expose port 5173 for Vite.
EXPOSE 5173

# Start the development server.
CMD ["npm", "run", "dev", "--", "--host", "0.0.0.0"]
````

Le fichier `docker-compose.yml` pourrait ressembler à ceci :

```yml
version: "3.8"
services:
  frontend:
    build:
      context: ./client
      dockerfile: Dockerfile
    ports:
      - "5173:5173"
    volumes:
      - ./client:/app
      - /app/node_modules
```

Enfin, avant de lancer l'application au sein d'un conteneur, on va devoir modifier le fichier `vite.config.js` pour que le serveur de développement soit certain de se mettre à jour en cas de modification du code source.

```js
import { fileURLToPath, URL } from "node:url";

import { defineConfig } from "vite";
import vue from "@vitejs/plugin-vue";

// https://vitejs.dev/config/
export default defineConfig({
  plugins: [vue()],
  resolve: {
    alias: {
      "@": fileURLToPath(new URL("./src", import.meta.url))
    }
  },
  server: {
    watch: {
      usePolling: true,
    },
  },
});
```
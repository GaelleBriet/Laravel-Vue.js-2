# Speech

## Introduction

Tu viens d'arriver dans une petite entreprise en tant que développeur Laravel et Vue.js. L'équipe passe beaucoup de temps à chiffrer des projets*. 
Entre le type de projet, les types de développements, le type de design, les développements très spécifiques, etc, ce n'est pas toujours évident.

Pour te mettre en jambe, ton *Lead Dev* te propose de faire un outil sur mesure pour estimer les temps d'un projet en fonction de ce que souhaitent les clients.

## 🗨️ Pitch de ton lead

Son idée, c'est d'avoir une interface simple avec un formulaire permettant de renseigner plusieurs informations :
- Un champ permettant de donner le **nom du projet**
- Un champ permettant de choisir le **type de projet** : 
  - *Laravel* ou *Laravel et Vue.js*
- Un champ permettant de choisir le **type de design** : 
  - *Simple*, *Complexe* ou *Complexe avec animations*
- Des *checkboxes* pour cocher des **développements classiques**, dont vous connaissez déjà les temps de développement : 
  - Homepage
  - Page éditorial
  - Événements
  - Offres d'emplois
  - Etc.
- (Bonus) La possibilité d'ajouter des développements spécifiques avec le temps que prennent chacun

À la soumission du formulaire, un algorithme calcul le temps total du projet et retourne le temps total ainsi que les temps par développements et les temps additionnels occasionnés par le type de projet et type de design.

Ton *Lead* a déjà réfléchi au projet et t'a fait une intégration disponible dans le dossier `integration` ici présent.  
Sens-toi libre de l'améliorer si tu le souhaites ! 

**❗ Tu devras développer ce projet en Laravel et Vue.js.**

**Côté Vue.js**, l'application se compose de 3 pages (utilisation de `vue-router`) : 
- La page d'accueil (doit contenir le formulaire d'estimation de temps).
- La page de listant les estimations.
- La page de détails d'une estimation (servira pour le résultat après calcul et aussi pour le détail des estimations déjà effectuées). 

Les labels, valeurs et types de champs devront provenir du backend (de la base de données) pour, à terme, pouvoir être administrable depuis le back-office. Cela permettra notamment de pouvoir ajouter de nouveaux développements génériques. Cela n'est pas prévu dans le parcours !

**Côté Laravel** : 
- Toutes les routes seront des routes d'API, qui seront utilisées par Vue.js.
- C'est de ce côté que tu devras faire l'algorithme d'estimation de temps avec les données envoyées par le front-end.

## 🧮 Comment calculer les estimations de temps ?

Tu peux retrouver ci-dessous les règles de gestion de cet outil.

### 📊 Les temps de mise en route du projet

En fonction des technos les temps de mises en places ne seront pas les mêmes

- Mise en route d'un projet full Laravel : **4h**
- Mise en route d'un projet Laravel et Vue.js : **6h**

### 📊 Les temps par développements

Génériques:
- Une page d'accueil : **7h**
- Une page de type éditorial : **5h**
- Évènements : **14h**
- Offres d'emplois : **16**
- Blog : **10h**

Additionnels:
- Pour un projet avec Vue.js, les temps de développements total sont augmentés de **25%**.
- En fonction du type du *design*, le temps total de développement du front-end est adapté : 
  - Simple : **0%** supplémentaire
  - Complexe : **15%** supplémentaire
  - Complexe avec animations : **20%**

⚠️ Attention, les pourcentages doivent être additionnés avant d'être appliqué sur le total, et pas calculés les uns après les autres sur le total.

Exemple :
```
temps_total=100
pourcentage_type_projet=25
pourcentage_type_design=15
pourcentage_total = pourcentage_type_projet + pourcentage_type_design

temps_total += temps_total * pourcentage_total / 100
```

## ⚙️ Un peu de pratique 

Avant de commencer : ton *Lead Dev* te demande aussi de :
- Faire le diagramme entité relation à partir du schéma qu'il a rapidement fait sur un outil en ligne. Tu dois le faire avec **Plant UML**.
  - Son [schéma](./diagramme/schema.png) est vraiment simpliste et il manque les cardinalités et relation, n'oublies rien !
- Faire l'algorithme du calcul d'une estimation en PHP. Un [fichier](./algo/index.php) est déjà disponible et devra être complété.

## ➕ Bonus
<details>
  <summary> Vraiment si tu as le temps !</summary>
Tout ne peut pas rentrer dans les critères plus haut, c'est pourquoi, tu dois aussi pouvoir estimer spécifiquement certaines fonctionnalités, en fonction des besoins client. 

Par exemple, ajouter un module météo sur le site. L'application ne pourra pas deviner le temps à passer dessus. Il faut donc ajouter un bouton pour pouvoir ajouter un groupe de champs autant de fois qu'on veut avec les champs suivants :
- Nom, soit le nom du développement
- Temps (ou heures), soit le nombre d'heures à passer dessus
</detail>





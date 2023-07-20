# Attendus

Tout ce qui est attendu sur ce parcours et atelier est présent sur cette page. N'hésite pas à te rendre sur cette page sur le GitHub de ton dépôt pour pouvoir cocher les étapes que tu as faites.

Il sera peut-être difficile de tout réaliser.   
🚧 On préfèrera 50% des fonctionnalités bien faites que 100% des fonctionnalités mal faites !


## Parcours (sur 2 jours)

### Jour #1 (matin)

- Slippers de **9h à 9h30** pour la présentation du parcours.

- Parcours : Conception (de **9h30 à 12h30**).

#### Activités

- [x] Remplir les différents **Quiz**
- [x] Faire le **diagramme d'entité/relation** de la base de données et mettre le code PlantUML correspondant avec un export en image dans le dossier `docs`. Il faut se baser sur ce [schéma](./diagramme/schema.png). On parle bien ici de diagramme d'entité/relation, et non de modèle conceptuel de données.
- [x] Faire **l'algorithme en PHP** : ça se passe dans le dossier [`algo`](./algo/index.php)

### Jour #1 (après-midi) jusqu'au jour #2 (soir)

Slippers de **13h30 à 14h00** pour débriefer la conception avec ton *Lead Dev* et parler de la suite.

- Parcours : Mise en place du projet.  
  - Jour #1 : Développement de **14h à 17h**.  
  - Jour #2 :  
    - Slippers avec *Lead Dev* à **9h00*.  
    - Développement de **9h30 à 12h** puis **13h à 17h**.   

#### Activités

- [x] Mettre en place l'environnement de développement avec Docker pour le back-end
- [x] Mettre en place le back-end avec Laravel
  - [x] Initialiser le projet dans un sous-dossier `backend`
  - [x] Créer les **migrations**
  - [x] Créer les **models**
  - [x] (Bonus : Créer les **relations**)
  - [x] Créer les **routes**
  - [x] Créer les **controllers** et **méthodes de routes** en retournant uniquement une réponse JSON contenant : `{"name": "nom de la page/route"}`. Rien d'autre en code.
  - [x] (Bonus : Créer les **seeders**) 
- [x] Mettre en place le front-end avec Vue.js
  - [x] Initialiser le projet dans un sous-dossier `frontend`
  - [x] Nettoyer les fichiers et code générés pour partir sur une page blanche
  - [x] Créer les composants des différentes pages à nu
  - [x] Créer les possibles composants communs
  - [x] Mettre l'intégration en dur dans les différentes pages
  - [x] (Bonus : Réfléchir à quels composants créer pour les champs de formulaire et créer ces composants à nu)
  - [x] (Bonus : créer le composant pour les développements supplémentaires)

## Atelier (3j)

Une fois toute la conception et la mise en place terminée, il est temps de coder réellement chaque fonctionnalité. 

Pour que tu ne sois pas pénalisé si tu n'as pas réussi à tout faire, nous mettons à ta disposition un nouveau O'Challenge avec toute la mise en place de faite. Ce n'est pas obligatoire, mais très recommandé pour que toi et ton binôme partiez avec un code propre commun.

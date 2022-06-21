# Parcours S07 :fire:

On souhaite mettre en place un site permettant de consulter et d'effectuer des **critiques de jeux vidéo**.

## Objectifs

- charger la liste des jeux vidéo dans le menu déroulant
- afficher les reviews après sélection d'un jeu vidéo
- ajouter un jeu vidéo
- Faire tout ça sans rechargement de la page

## Avant de commencer

Pendant la saison 7, nous avons codé dans 2 dépôts (_front_ et _back_) séparés mais aujourd'hui, pour le parcours, le front et le back sont réunis dans le même dépôt :fearful:  
**Pas de panique**, car tout est bien rangé à sa place. :relieved:

### Le code front est dans le répertoire `frontend`

- On y trouve :
  - un fichier `index.html` qui sera la seule page d'accès au site
  - un répertoire `js` qui contient un fichier `app.js` qui contiendra le module dans lequel il faut coder l'application (il n'est pas nécessaire de splitter l'application en plusieurs fichiers/modules, mais tu peux le faire si tu le souhaites)
- [Plus de détails ici](frontend/readme.md)

### Le code back est dans le répertoire `backend`

- On y trouve :
  - une installation de _Laravel_ à finaliser :warning:  
    - installation des dépendances à faire depuis le répertoire `backend`
    - création du fichier de configuration Laravel utile notamment pour l'accès à la base de données
  - une partie du code back déjà en place avec des routes, des contrôleurs et des modèles, à vous de compléter ce code de départ :muscle: 
- [Plus de détails ici](backend/README.md)

## Étapes

### #0 Base de données :floppy_disk:

Créer une base de données nommée `game-reviews` et importer tables et données ([fichier docs/import.sql](./docs/import.sql)) :tada:

Dans ce dossier [docs](./docs) il y a aussi pas mal de documents intéressants à regarder avant de te lancer.


---
:warning: Les etapes 1 à 3 peuvent etre faites dans l'ordre que tu préfères :warning:
---

### #1 Afficher les reviews après la sélection d'un jeu vidéo :eye:

<details><summary>Démo</summary>

![screenshot_afficher_reviews](img/display_reviews.gif)

</details>

#### Dans le Backend

Il n'y a rien à faire, le endpoint pour récupérer les reviews est déjà en place.  
Tu peux le tester avec _Insomnia_.

> Une configuration pour Insomnia est fournie dans [docs/Insomnia_import_game-reviews.json](./docs/Insomnia_import_game-reviews.json), que tu peux importer dans le logiciel.

#### Dans le Frontend

- Lorsque on sélectionne un jeu vidéo dans le menu déroulant
- récupérer l'id du jeu vidéo
- effectuer une requête HTTP [de type _Fetch_](#-rappel-requête-fetch) sur le bon endpoint de l'API, afin de récupérer les reviews liées à ce jeu vidéo
- une fois la réponse reçue
  - Créer un nouvel element DOM statique qui contiendra une review
  - Puis pour chaque review
    - créer une instance de cet élément DOM
    - Dynamiser la review statique avec la réponse du backend
    - les données reçues ne contiennent pas l'éditeur, ni la plate-forme. Ce n'est pas grave, on va faire sans, on s'en occupera en **bonus**
    - ajouter chaque review dans le DOM de la page

### #2 Charger la liste des jeux vidéo dans le menu déroulant :camel:

#### Backend

- créer la route, le _Controller_ et le _Model_ (si nécessaire)
- dans la méthode du _Controller_
  - récupérer tous les enregistrements de la table _videogames_
  - retourner une réponse HTTP avec le code 200 contenant au format JSON tout les videogames
  - jetter un :eye: sur le _ReviewController_ peut être utile :wink:
- tester avec _Insomnia_

#### Frontend

- supprimer du code HTML les balises `<option>` du menu déroulant (sauf la première qui est la valeur par défaut)
- compléter la méthode `app.loadVideoGames()` fournie dans [app.js](./frontend/js/app.js)
  - effectuer une requête HTTP [de type _Fetch_](#-rappel-requête-fetch) sur le bon endpoint de l'API pour recuperer la liste de tous les jeux vidéos
  - une fois la réponse reçue,
    - pour chaque jeu vidéo
      - ajouter un élément `<option>` dans le menu déroulant contenant les même types de données que la version statique ( titre et ID )

### #3 Ajouter un jeu vidéo :heavy_plus_sign:

#### Backend

- créer la route, le _Controller_ et le _Model_ (si nécessaire)
- dans la méthode du _Controller_
  - récupérer toutes les données du formulaire
  - créer un enregistrement dans la base de données
  - Renvoyer une réponse selon le succès de l'insertion 
- tester le fonctionnement avec _Insomnia_

#### Frontend

- lors de la soumission du formulaire ajout d'un jeux video
  - récupérer toutes les données du formulaire
  - effectuer une requête HTTP [de type _Fetch_](#-rappel-requête-fetch) sur le bon endpoint de l'API contenant les données du formulaire
    - une fois la réponse reçue et selon la réponse reçue
      - afficher un message de succès
      - afficher un message d'échec

### 💡 Rappel requête _Fetch_

<details><summary>Code minimal</summary>

```js

// Options si nécessaire
  
let fetchOptions = {
  method: 'GET',
  mode: 'cors',
  cache: 'no-cache',
  // Optionnel : pour envoyer des données avec la requête, où "data" est un tableau de données
  body : JSON.stringify(data)
};
  
// Endpoint à appeler

fetch('http://votre_endpoint_ici', fetchOptions)
    .then(
        // 1. On récupère d'abord la réponse JSON que l'on retourne...
        function (response) {
            return response.json();
        }
    )
    .then(
        // 2. ...et qu'on récupère sous forme d'objet JS
        function (object) {
            // On peut travailler avec l'objet reçu !
            console.log(object);
        }
    );
```

</details>

## Bonus :rainbow:

[Par ici](bonus.md) les bonus !

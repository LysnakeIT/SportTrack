<h1 align="center">SportTrack Web Application</h1>

SportTrack est un site permettant a ses utilisateurs de poster leurs activités sportives avec des commentaires et des données telles que les coordonnées de chaque étape ou les heures de début et de fin, de manière à pouvoir connaître des choses telles que leurs distances parcourues et le temps qu'ils ont mis à les parcourir.<br/>
Le site permet une création de compte gratuite et utilise l'adresse électronique de l'utilisateur pour l'identifier.

SportTrack Partie PHP
======

Ce dossier contient tous les fichiers sources du site SportTrack
Les fichiers importants sont, entre autres, la base de données (resources/sport_track.db), les dossier model, view et controllers, ainsi que le fichier index.php, présent dans la racine.

__Utilisation application:__
- La création d'un compte se fait via le bouton "Creation de profil" qui redirige l'utilisateur vers un formulaire de création de compte. (NB : après la création d'un compte, l'utilisateur n'est pas directement connecté). Lors de la création de compte il faut respecter certaine norme pour la taille par exemple si on fait 1 mètre 76 il faut rentrer 1.76, pour l'email il faut un email se terminant par .com et pour finir le mot de passe doit contenir minimum 8 caractères avec au moins une majuscule, une minuscule et un chiffre.
- La connexion se fait via le bouton "Connexion" qui redirige l'utilisateur vers un formulaire de connexion.
- L'ajout d'activité (une fois connecté) se fait via le bouton "Uploader un fichier JSON" qui redirige vers un formulaire d'upload de fichier. Seuls les fichiers aux formats JSON et respectant une structure précise (activités, données) sont acceptes, de plus le fichier doit avoir un volume inférieur à 20 kb.
- La lecture des activites enregistrées par l'utilisateur se fait via le bouton "Liste des activites" qui redirige vers une page contenant un tableau répertoriant toutes les activités de l'utilisateur. (depuis cette page, il est possible de revenir à la page d'accueil, d'ajouter une activité ou de se déconnecter par le biais de bouton).
- La déconnexion se fait via le bouton "Deconnexion" qui redirige automatiquement l'utilisateur vers la page d'accueil après quelques secondes.


SportTrack Partie JS
======

Ce dossier contient tous les fichiers sources du site SportTrack version JS App
Les fichiers importants sont, entre autres, la base de données se trouvant dans notre module sport-track-db(sport-track-db/sport_track.db), les dossiers routes et views, ainsi que le fichier app.js, présent dans la racine de notre application web Express (express_webapp/routes; express_webapp/views; express_webapp/app.js)

__Installation :__

- Se rendre dans le dossier ("module") sport-track-db, puis faire la commande npm install
- Se rendre dans le dossier ("module") express_webapp, puis faire la commande npm install

__Lancement application :__

Afin de lancer l'application web Express, il faut se trouver dans le répertoire express_webapp (et avoir respecté toutes les conditions ci-dessus) et taper "npm start" dans un terminal, puis aller dans un navigateur web et se rendre à l'adresse suivante : http://localhost:3000/

__Utilisation application:__

- La création d'un compte se fait via le bouton "Creation de profil" qui redirige l'utilisateur vers un formulaire de création de compte. (NB : après la création d'un compte, l'utilisateur n'est pas directement connecté). Lors de la création de compte il faut respecter certaines normes pour la taille par exemple si on fait 1 mètre 76 il faut rentrer 1.76, pour l'email il faut un email se terminant par .com et pour finir le mot de passe doit contenir minimum 8 caractères avec au moins une majuscule, une minuscule et un chiffre.
- La connexion se fait via le bouton "Connexion" qui redirige l'utilisateur vers un formulaire de connexion.
- La lecture des activités enregistrées par l'utilisateur se fait via le bouton "Liste des activites" qui redirige vers une page contenant un tableau répertoriant toutes les activités de l'utilisateur. (depuis cette page il est possible de revenir à la page d'accueil, d'ajouter une activité ou de se déconnecter par le biais de bouton).
- La déconnexion se fait via le bouton "Deconnexion" qui redirige automatiquement l'utilisateur vers la page d'accueil.

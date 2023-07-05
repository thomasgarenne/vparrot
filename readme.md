Site Vitrine Garage Automobile, Vente véhicule d'occasion


DESCRIPTION

Ce projet a pour but de mettre en avant les différents services qu'un garage automobile peut proposer ainsi qu'une partie lui permettant de mettre des véhicules d'occasion à la vente.

Les visiteurs auront accès à une page d'accueil leurs présentant les nouvelles voitures d'occasion, les principaux services du garage ainsi que les avis utilisateurs.
Ils auront accès à une page de << Mécanique >> qui présentera tous les services, une page << Carrosserie >> qui leurs permettront de demander un devis et une page << Occasions >> où ils retrouveront tout les véhicules d'occassions.
Sur cette page ils auront la possibilité de filtrer le contenu sans rechargement de la page mais aussi de cliquer sur un véhicule pour accéder à une page plus détaillés.
Celle-ci contiendra une galerie de photo, des informations complémentaire ainsi qu'un formulaire de contact avec la référence du véhicule pré-remplit 
Ils pourront cliquer sur un lien qui leurs permettront de voir la liste des avis laissés mais aussi laisser le leurs qui apparaitra une fois validé.
Les informations de contact et les horaires d'ouverture se trouve dans le pied de page.

Du côté de l'entreprise les employés ont accès à un espace dédié leurs permettant d'ajouter, de modifier et de supprimer du contenu pour gérer la page des véhicules d'occasions, comme l'ajout de nouveaux constructeurs, de nouveaux modèles de voiture qui seront ensuite intégrer dans le formulaire d'ajout de véhicule.
Lors de l'ajout d'un véhicule, une date de création est ajouté automatiquement ainsi qu'une référence aux véhicules.
De plus les employés auront accès à un espace de validation des avis utilisateurs du site. Ils auront alors la possibilté de les validers et les 3 derniers commentaires (valides) seront alors afficher sur la page d'accueil.

Le gérant du garage, sera l'administrateur du site et se verra attribuer la responsabilité de la creation ses employé, il aura la possibilité d'ajouter de nouveaux services, de modifier les horaires d'ouverture et de fermeture de son garage en plus des fonctionnalités employés.


TABLE DES MATIERES

Installation
Utilisation
Contribuer
Structure du projet
Contact


INSTALLATION

Clonez ce dépôt sur votre machine locale : 
- https://github.com/thomasgarenne/vparrot.git.
Assurez-vous d'avoir installé PHP et Composer sur votre machine.
Exécutez la commande composer install pour installer les dépendances du projet.
Configurez votre base de données dans le fichier .env.local en mettant à jour les paramètres de connexion.
Créez la base de données avec la commande php bin/console doctrine:database:create.
Exécutez les migrations pour créer les tables de la base de données avec la commande php bin/console doctrine:migrations:migrate.
Remplissez votre base de données à l'aide des DataFixtures avec la commande php bin/console doctrine:datafixtures:load.
Démarrez le serveur de développement avec la commande symfony server:start.
Accédez au site via votre navigateur à l'adresse https://127.0.0.1:8000/.


UTILISATION

Créez un compte utilisateur pour accéder à toutes les fonctionnalités du site.
Recherchez des voitures en utilisant les filtres disponibles (marque, modèle, catégorie, etc.).
Consultez les détails d'une voiture pour obtenir des informations telles que le prix, l'année de fabrication, le kilométrage, etc.
Publiez une annonce pour vendre votre propre voiture en fournissant tous les détails nécessaires.
Contactez le vendeur d'une voiture en utilisant les informations de contact fournies dans l'annonce.
Gérez vos annonces publiées et vos informations personnelles depuis votre profil utilisateur.


CONTRIBUER

Nous encourageons les contributions de la communauté ! Si vous souhaitez contribuer à ce projet, veuillez suivre les étapes suivantes :

Fork ce dépôt et clonez-le localement.
Créez une branche pour votre contribution avec git checkout -b feature/nom-de-la-branche.
Effectuez vos modifications et testez-les.
Committez vos changements avec un message descriptif.
Poussez vos modifications vers votre dépôt forké.
Ouvrez une pull request vers la branche principale de ce dépôt.


STRUCTURE DU PROJET

config/ : Contient les fichiers de configuration du projet Symfony.
src/ : Les fichiers source du projet Symfony.
templates/ : Les templates Twig pour les vues du site.
public/ : Les fichiers publics (CSS, JS, images) utilisés par le site.
migrations/ : Les migrations de base de données.
vendor/ : Les dépendances installées par Composer.
bin/ : Les scripts binaires Symfony.
tests/ : Les tests unitaires et fonctionnels.
.env : Le fichier de configuration des variables d'environnements


CONTACT

Pour toute question ou suggestion, n'hésitez pas à me contacter par e-mail à votre-email@example.com.

BlogCMS - Console Edition
Description

BlogCMS Console Edition est une application PHP en console qui permet de gérer un blog avec plusieurs types d'utilisateurs : Visiteur, Auteur, Éditeur et Administrateur. Chaque type d’utilisateur a des droits et fonctionnalités différents.

Le projet utilise la programmation orientée objet (POO) avec des concepts comme l’héritage, la composition et les collections singleton pour stocker les données en mémoire.

Fonctionnalités
Pour les visiteurs (non connectés) :

Voir tous les articles.

Se connecter.

Pour les auteurs :

Voir leurs articles.

Créer un nouvel article.

Voir leurs informations.

Se déconnecter.

Pour les éditeurs :

Voir tous les articles.

Changer le statut d’un article (Publier/Draft).

Modifier un commentaire.

Supprimer un commentaire.

Se déconnecter.

Pour les administrateurs :

Voir tous les articles.

Créer, modifier et supprimer des articles.

Gérer les utilisateurs (créer, modifier, supprimer).

Gérer les catégories (créer, modifier, supprimer).

Voir les statistiques du système.

Se déconnecter.

Structure des classes

User : classe de base pour tous les utilisateurs.

moderateur : hérite de User.

Auteur : hérite de User, possède un tableau d’articles (composition).

Editeur : hérite de moderateur, peut modifier les articles et commentaires.

Admin : hérite de moderateur, peut gérer tout le système.

Article : contient titre, contenu, statut, catégories, commentaires.

Categorie : contient nom et description.

Commentaire : contient contenu, auteur, article.

Collection : singleton pour stocker tous les objets (users, articles, catégories, commentaires).
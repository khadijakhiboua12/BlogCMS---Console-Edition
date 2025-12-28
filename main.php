
<?php

  require_once 'file.php';

/**
* TÂCHE 2 - DYNAMIC_MENU.php
* Menu qui change si l'utilisateur est connecté ou non
*/


echo "=== BLOGCMS CONSOLE AVEC AUTHENTIFICATION ===\n";

$db = Collection::getInstance(); 

// ajouter_user($db); // Ajoute les utilisateurs de test
$running = true;

while ($running) {
if (!$db->isLoggedIn()) {

    // 🔹 VISITEUR
    echo "1. Voir tous les articles\n";
    echo "2. Se connecter\n";
    echo "0. Quitter\n";

} else {

    $user = $db->getCurrentUser();

    // 🔹 AUTEUR
    if ($user instanceof Auteur) {

        echo "1. Voir mes articles\n";
        echo "2. Créer un nouvel article\n";
        echo "3. Voir mes informations\n";
        echo "4. Se déconnecter\n";
        echo "0. Quitter\n";

    }
    // 🔹 EDITEUR
    elseif ($user instanceof Editeur) {

        echo "1. Voir tous les articles\n";
        echo "2. Changer statut d’un article\n";
        echo "3. Modifier un commentaire\n";
        echo "4. Supprimer un commentaire\n";
        echo "5. Se déconnecter\n";
        echo "0. Quitter\n";

    }
    // 🔹 ADMIN
    elseif ($user instanceof Admin) {

        echo "1. Voir tous les articles\n";
        echo "2. Créer un article\n";
        echo "3. Gérer les utilisateurs\n";
        echo "4. Gérer les catégories\n";
        echo "5. Voir statistiques\n";
        echo "6. Se déconnecter\n";
        echo "0. Quitter\n";
    }
}

$choice = readline("Votre choix : ");

// ===== VISITEUR =====
if (!$db->isLoggedIn()) {

    switch ($choice) {

        case '1':
            foreach ($db->getArticles() as $article) {
                echo "- {$article->getTitle()} ({$article->getStatus()})\n";
            }
            break;

        case '2':
            $email = readline("Email : ");
            $password = readline("Password : ");
            if ($db->login($email, $password)) {
                echo "Connexion réussie !\n";
            } else {
                echo "Échec de connexion\n";
            }
            break;

        case '0':
            $running = false;
            break;

        default:
            echo "Choix invalide\n";
    }

}
// ===== UTILISATEUR CONNECTÉ =====
else {

    $user = $db->getCurrentUser();

    // ===== AUTEUR =====
    if ($user instanceof Auteur) {

        switch ($choice) {

            case '1':
                echo "Articles de l'auteur : {$user->getUsername()}\n";
                foreach ($user->getArticles() as $art) {
                    echo "- {$art->getTitle()} ({$art->getStatus()})\n";
                }
                break;

            case '2':
                $cat1 = new Categorie(1, 'poo', 'nari');
                $article1 = new Article(1, "svt", "svt est bonne", "laila", "publier", [$cat1], []);
                $user->creer_Article($article1);
                echo "Article créé avec succès\n";
                break;

            case '3':
                echo "👤 Username: {$user->getUsername()}\n";
                echo "🎭 Rôle: Auteur\n";
                break;

            case '4':
                $db->logout();
                echo "Déconnexion réussie\n";
                break;

            case '0':
                $running = false;
                break;
        }
    }

    // ===== EDITEUR =====
    elseif ($user instanceof Editeur) {

        switch ($choice) {

            case '1':
                foreach ($db->getArticles() as $art) {
                    echo "- {$art->getTitle()} ({$art->getStatus()})\n";
                }
                break;
            case '2':
        $db = Collection::getInstance();
        $articles = $db->getArticles();

         echo "entrez ID de l'article : ";
         $id = (int) readline();

       foreach ($articles as $art) {
              if ($art->getId() === $id) {
              $user->changerStatus($art,'publier');
             echo "statut change avec succes\n";
             
    }
}

                break;
        case '3': // Modifier commentaire

            $id = (int) readline("ID du commentaire : ");
            $newComment = readline("Nouveau commentaire : ");

            $user->modifier_commentaire($id,$newComment);

            break;
         case '4': // Supprimer un commentaire
            $id = (int)readline("ID du commentaire à supprimer: ");

         // verification
              $commentExists = false;
             foreach ($db->getCommentaires()as $com) {
                 if ($com->getId() === $id) {
                            $commentExists = true;
                            break;
    }
}
             if ($commentExists) {
                $user->supprimer_coment_BYId($id);
             } else {
             echo "erreur:commentaire avec ID $id n'existe pas.\n";
}
     break;
            case '5':
                $db->logout();
                echo "Deconnexion reussie\n";
                break;

        }
    }

    // ===== ADMIN =====
    elseif ($user instanceof Admin) {

        switch ($choice) {

            case '1':
                foreach ($db->getArticles() as $art) {
                    echo "- {$art->getTitle()} ({$art->getStatus()})\n";
                }
                break;

            case '5':
                $user->voirStatistique();
                break;

            case '6':
                $db->logout();
                echo "Déconnexion réussie\n";
                break;
        }
    }
}

}
?>
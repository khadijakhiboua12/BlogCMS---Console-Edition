<?php
  require_once 'file.php';
 //========================================================================================================
                    //   MAIN PRANCIPALE
 //========================================================================================================

//  $user=new Auteur(1,"khadija","khadija@gmail.com","1234");
//  echo $user->getArticles();
//  $article= new Article(1, "POO en PHP", "Contenu de l'article 1","hcfh","publier");

// $auteur=new Auteur("Je suis dev", 1, "Khadija", "khadija@gmail.com", "1234");
// $comment=new commentaire(1,"hello",$auteur,$article);
// echo $comment->getContenu();

// //pour creer articel a partir  d'un auteur
// echo $auteur->creer_Article($article);
// $auteur->getArticles();


 $collection = Collection::getInstance();
// Test 1: Connexion réussie
$result =  $collection->login('khadija@gmail.com', '1234');
echo $result ? "Connexion alice OK" : "Échec connexion alice";
// Test 2: Connexion échouée (mauvais mot de passe)
$result = $collection->login('alice', 'wrongpass');
echo !$result ? "Rejet mauvais mot de passe OK" : "Problème vérification";
// Test 3: Vérification état connexion
if ($collection->isLoggedIn()) {
$user = $collection->getCurrentUser();
echo "Utilisateur connecté: " . $user->getUsername();
// Test 4: Déconnexion
$collection->logout();
echo !$collection->isLoggedIn() ? "Déconnexion OK" : "Problème déconnexion ";

//POUR ADMIN
$admin = new Admin(true,1,'admin','admin@gmail.com','123');
$newuser=new Auteur("Je suis prof", 28, "khadija", "khadija@gmail.com", "900");
// $newArticle=new Article(2,"maths","islamic est  bonne ","yasmine","jjjj");
 $cat1=new categorie(1,'poo','nari');
$newcategorie=new categorie(19,'pappa','yelo');
// $admin->creeUser($newuser);
//  $admin->suppimerUser(2);
// $ancienuser=$collection->getStorage()['users'][1];
// $admin->modifier($ancienuser,$newuser);
// $admin->supprimer_article_BYId(2);
// $ancienArticle=$collection->getStorage()['articles'][1];
// $admin->modifier_article(2,$newArticle);
// $admin->creer_categorie($cat1);
$admin->supprimer_categorie_BYId(2);
// $admin->modifier_categorie_BYID(2,$newcategorie);
print_r($collection->getStorage());
}
?>
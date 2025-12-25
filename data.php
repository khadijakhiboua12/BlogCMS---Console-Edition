<?php


$auteur1=new Auteur("Je suis dev", 1, "Khadija", "khadija@gmail.com", "1234");
$auteur2=new Auteur("Backend dev", 2, "Sami", "sami@gmail.com", "abcd");
$allAuteur=[$auteur1,$auteur1];

$article1=new Article(1, "POO en PHP", "Contenu de l'article 1","hcfh","publier");
$article2=new Article(2, "MYSQL", "Contenu de l'article 2","cv dje","brouille");
$article3=new Article(3, "JAVA", "Contenu de l'article 3","ejj euq","publier");
$article4= new Article(1, "POO en JAVA", "Contenu de l'article 3","hcfh","Adraft");

$allArticle = [$article1,$article2,$article3,$article4];

$allCommentaire = [
 new commentaire(1, "Super article!", $auteur1, $article1),
 new commentaire(2, "Merci!", $auteur1, $article1),
 new commentaire(3, "Intéressant", $auteur2, $article2)
];
?>
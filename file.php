<?php
 class User{
   private int $id;
   private string  $username;
   private string $email;
   private string $password;
   private string $role;
   private   DateTime $createdAt;
   private DateTime $lastLogin;
 }
 class moderateur{

 }
  class Auteur extends User{
     private string $bio;
     private array $article;//array des articles puisique il exixte la composition
 }
 class Editeur extends moderateur {
    private string $moderationLevel;
}
 class Admin extends moderateur{
    private bool $isSuperAdmin;
}
 class Article{
    private int $id;
    private string $title;
    private string $content;
    private  string $excerpt;
    private string $status;
    // private User $author;
    private DateTime $createdAt;
    private DateTime $publishedAt;
    private DateTime $updatedAt;
    private array $commentaire;//array des commentaire puisique il exixte la composition
    private array $categorie;//puisque existe la cardinalite entre article et categorie

}
 class categorie{
     private int $id;
     private string $name;
     private string $description;
     private category $parent;
     private DateTime $createdAt;
 }
 class commentaire{
     private int $id;
     private string $contenu;
     private DateTime $updatedAt;
     private Auteur $auteur;
 }

?>
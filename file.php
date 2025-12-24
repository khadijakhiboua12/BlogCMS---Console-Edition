<?php

include 'data.php';
 class User{
    //les attributes
   private int $id;
   private string  $username;
   private string $email;
   private string $password;
//    private array $article=[];
   private   DateTime $createdAt;
   private DateTime $lastLogin;
   private array $commentaire;
   //la constructeur
   public function __construct($id,$username,$email,$password){
       $this->id=$id;
       $this->username=$username;
       $this->email=$email;
       $this->password=$password;
     
       $this->createdAt=new DateTime();
       $this->lastLogin=new DateTime();
       $this->commentaire=[];
   }
   //geters
    public function getUsername(){
          return $this->username;
    }
    //les methodes
        //1)Liste les articles
    public function liste_Article($allArticle):void{
        echo "Liste d'article est :\n";
        
         foreach($allArticle as $art){
          echo  $art->getTitle() . " "  . $art->getContent() ." " . $art->getExcerpt() ." " . $art->getStatus() ."\n";
         }
    }
        //2)Ajouter commentaire
     public function Ajouter_Commentaire($commentaire):void{
                 $this->commentaire[]=$commentaire;
     }


 }

 class moderateur extends User{
     
 }
  class Auteur extends User{
     private string $bio;
     private array $articles;//array des articles puisique il exixte la composition
    //  private array $commentaire;//puisuqe il existe une relation entre auteur et commentaire
    //constructeur
    public function __construct($bio,$id,$username,$email,$password){
        parent::__construct($id,$username,$email,$password);
        $this->bio=$bio;
        $this->articles=[];
    }
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
    private string $excerpt;
    private string $status;
    // private User $author;
    private DateTime $createdAt;
    private DateTime $publishedAt;
    private DateTime $updatedAt;
    private array $commentaire;//array des commentaire puisique il exixte la composition
    private array $categorie;//puisque existe la cardinalite entre article et categorie
    //constructeur
    public function __construct($id,$title,$content,$excerpt,$status){
           $this->id=$id;
           $this->title=$title;
           $this->content=$content;
           $this->excerpt=$excerpt;
           $this->status=$status;
           $this->createdAt=new DateTime();
           $this->publishedAt=new DateTime();
    }
    public function getTitle(){
         return $this->title;
    }
   public function getContent(){
        return $this->content;
   }
   public function getExcerpt(){
       return $this->excerpt;
   }
   public function getStatus(){
       return $this->status;
   }
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
     private Article $article;
     //constructeur
    public function __construct($id,$content,$auteur,$article){
            $this->id=$id;
            $this->contenu=$content;
            $this->updatedAt=new DateTime();
            $this->auteur=$auteur;
            $this->article=$article;
   }
    //les getters
    public function getContenu(){
          return $this->contenu;
     }
      

 }

 //Le main

 $user=new User(1,"khadija","khadija@gmail.com","1234");
 echo $user->liste_Article($allArticle);
 $article= new Article(1, "POO en PHP", "Contenu de l'article 1","hcfh","publier");

$auteur=new Auteur("Je suis dev", 1, "Khadija", "khadija@gmail.com", "1234");
$comment=new commentaire(1,"kkkkk",$auteur,$article);
echo $comment->getContenu();


 
?>

<?php
require_once 'data.php';
 class User{
    //les attributes
   private int $id;
   private string  $username;
   private string $email;
   private string $password;
   private string $role;
   private   DateTime $createdAt;
   private DateTime $lastLogin;
   //la constructeur
   public function __construct($id,$username,$email,$password,$role){
       $this->id=$id;
       $this->username=$username;
       $this->email=$email;
       $this->password=$password;
       $this->role=$role;
       $this->createdAt=new DateTime();
       $this->lastLogin=new DateTime();
   }
   //geters
    public function getUsername(){
          return $this->username;
    }
    //les methodes
    public function liste_Article(array $article){
         foreach($article as $art){
          echo $art->getTitle()   $art->getContent()  $art->getExcerpt()  $art->getStatus() ."\n";
         }
    }

 }

 class moderateur extends User{
     
 }
  class Auteur extends User{
     private string $bio;
     private array $article;//array des articles puisique il exixte la composition
     private array $commentaire;//puisuqe il existe une relation entre auteur et commentaire
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
 }
 $user=new User(1,"khadija","khadija@gmail.com","1234","admin");
 echo $user->liste_Article($allArticle);
 
?>
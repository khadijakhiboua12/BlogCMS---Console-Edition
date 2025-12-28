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
    public function getId(){
       return $this->id;
}
    public function getUsername(){
          return $this->username;
    }
    public function getEmail(){
          return $this->email;
    }
    public function getPassword(){
         return $this->password;
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
        //1)Ajouter commentaire
     public function Ajouter_Commentaire($commentaire):void{
                 $this->commentaire[]=$commentaire;
     }
        //2)creer article
    public function creer_Article(Article $article):void{
             $this->articles[]=$article;
    }
     //afficher article
     public function getArticles(){
        echo "Articles de l'auteur : " . $this->getUsername() . "\n";
        foreach( $this->articles as $art){
        echo  $art->getTitle() . " "  . $art->getContent() ." " . $art->getExcerpt() ." " . $art->getStatus() ."\n";
        }
     }
     //supprimer article
      public function supprimerArticle(Article $art){
                unset($this->art);
      }



 }

 class Editeur extends moderateur {
    private string $moderationLevel;//junior..

        public function __construct($moderationLevel,$id,$username,$email,$password){
        parent::__construct($id,$username,$email,$password);
        $this->moderationLevel=$moderationLevel;
        }
        //changer status d'articles
        public function changerStatus(Article $article,string $nouvArticle){
             $colection=Collection::getInstance();
            foreach($colection->getArticles() as $art){
             if($art->getId()===$article->getId()){
              if($nouvArticle==='publier')
               $art->publier();
              else
                $art->depublier();
              }
            }
        }
        //modifier commentaire
        public function modifier_commentaire(int $id,string $coment){
            $colection=Collection::getInstance();
            $colection->modifier_comment($id,$coment);
            echo"la modification d'article est avec succe";
        }
       
        
}

 class Admin extends moderateur{
    private bool $isSuperAdmin;
        public function __construct($isSuperAdmin,$id,$username,$email,$password){
        parent::__construct($id,$username,$email,$password);
        $this->isSuperAdmin=$isSuperAdmin;
    }
    //creer user
      public function creeUser(User $user):void{
            $colection=Collection::getInstance();
            $colection->ajouter_user($user);
            echo "la creation est avec sucee";
      }
      //supprimer user
        public function suppimerUser(int $id):void{          
            $colection=Collection::getInstance();
            $colection->supprimer_user_ById($id);
            echo "la supprision est avec succe";
    }
    //modfier  user
       public function modifier(User $user,User $new){
           $colection=Collection::getInstance();
           $colection->modifier_user($user,$new);
           echo "la modification est  avec sucee";
       }
    //supprimer articles
       public function supprimer_article_BYId(int $id){
          $colection=Collection::getInstance();
          $colection->supprimer_article_BYId($id);
          echo"la supprision d'un articles est avec succe";
       }
    //modifier article
       public function modifier_article(int $id,Article $newarticle){
          $colection=Collection::getInstance();
          $colection->modifier_article_ID($id,$newarticle);
           echo "la modification est  avec sucee pour article";
       }
       //cree categorie
       public function creer_categorie(categorie $cat){
         $colection=Collection::getInstance();
         $colection->ajouter_categorie($cat);
         echo "l'ajoute de categorie est bien";
       }
      //suuprimer categorie
      public function supprimer_categorie_BYId(int $id){
        $colection=Collection::getInstance();
        $colection->supprimer_categorie_BYID($id);
        echo "la supprision de categorie est avec succe";
      }
      //modifier categorie
      public function modifier_categorie_BYID(int $id,categorie $newcat){
            $colection=Collection::getInstance();
            $colection->modifier_categorie($id,$newcat);
            echo"la modification est avec succe";
      }
      //les statistique
      public function voirStatistique(){
        $colection=Collection::getInstance();
         $statique=$colection->getstatistique();
         echo"statistique systeme\n";
         print_r($statique);
      }
      
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
    private array $categorie;//puisque existe la cardinalite entre article et categorie
    private array $commentaire;//array des commentaire puisique il exixte la composition

    //constructeur
    public function __construct($id,$title,$content,$excerpt,$status,$cat,$comment){
           $this->id=$id;
           $this->title=$title;
           $this->content=$content;
           $this->excerpt=$excerpt;
           $this->status=$status;
           $this->createdAt=new DateTime();
           $this->publishedAt=new DateTime();
           $this->categorie=$cat;
           $this->commentaire=$comment;
    }
     public function getId(){
       return $this->id;
}
       public function getCategorie(): array {
        return $this->categorie;
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
   public function getComment(){
       return $this->commentaire;
   }
   //seters
    public function setId(int $id){
        $this->id=$id;
}
 public function setCategorie(array $cats): void {
        $this->categorie = $cats;
    }
   public function setTitle(string $titre){
      $this->title=$titre;
   }
    public function setContent(string $content){
      $this->content=$content;
   }

    public function setExcerpt(string $excerpt){
      $this->excerpt=$excerpt;
   }

    public function setStatus(string $status){
      $this->status=$status;
   }
    public function publier(){
            $this->status='publier';
}
    public function depublier(){
            $this->status='draft';
    }

   //supprimer categorie
   public function supprimerBYID(int $id){
     foreach($this->categorie as $key=> $art){
         if($art->getId()==$id)
            unset($this->categorie[$key]);
     }
   }
   //ajoute commentaire
   public function ajoutecomment(commentaire $comment){
      $this->commentaire[]=$comment;
   }
}


 class categorie{
     private int $id;
     private string $name;
     private string $description;
     private DateTime $createdAt;

     public function __construct(int $id, string $name, string $desc){
        $this->id = $id;
        $this->name = $name;
        $this->description = $desc;
        $this->createdAt=new DateTime();
    }

    public function getId(){
         return $this->id;
     }
    public function getName(){
         return $this->name;
     }
    public function getDescription(){
         return $this->description; 
    }
    public function setId(int $id){
         $this->id=$id;
    }
    public function setName(string $name){
         $this->name=$name;
    }
    public function setdescription(string $desc){
         $this->description=$desc;
    }


 }
 class commentaire{
     private int $id;
     private string $contenu;
     private DateTime $updatedAt;
     private Article $article;
    private Auteur $auteur;
    
     //constructeur
    public function __construct($id,$content,$article,$auteur){
            $this->id=$id;
            $this->contenu=$content;
            $this->updatedAt=new DateTime();
            $this->article=$article;
            $this->auteur=$auteur;
            
   }
    //les getters
      public function getId(){
         return $this->id;
     }
    public function getContenu(){
          return $this->contenu;
     }

    public function setcontent(string $contenu){
         $this->contenu=$contenu;
    }
    

 }






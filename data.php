
<?php
class Collection {
    private static $instance = null;
    private $current_user = null;
    private $storage = [];
  
    
    private function __construct() {
       
       
        $cat1 = new Categorie(1, 'poo', 'nari');
        $cat2 = new Categorie(2, 'php', 'facile');

        $article1 = new Article(1, "maths", "maths est bonne", "khadija", "publier", [$cat1], []);
        $article2 = new Article(2, "pc", "pc est bonne", "salma", "draft", [$cat2], []);

    
        $auteur1 = new Auteur('hh', 1, 'salim', 'salim@gmail.com', '1234', [$article1]);
        $auteur2 = new Auteur('hh', 2, 'khadija', 'khadija@gmail.com', '1234', [$article2]);

        // 4. Commentaires
        $coment1 = new Commentaire(1, 'wowo', $article1, $auteur1);
       
        $article1->ajoutecomment($coment1);

        $this->storage = [
          'users' => [new User(1,'khadija','khadija@gmail.com','1234'),
            new Auteur('hh',1,'khadija','khadija@gmail.com','1234',[$article1]),
            new Editeur('hi',3,'sara','sara@gmail.com','1234'),
            new Admin(true,1,'admin','admin@gmail.com','123')],
           'categories' => [$cat1,$cat2],
            'articles'=>[$article1,$article2],
            'commentaires' => [$coment1]
           
        ];
       

    }  
    //function de storage
       public function getStorage():array{
         return $this->storage;
       }
    // //function de getuser
       public function getUser():array{
         return $this->storage['users'];
       }
     //function de getcategorie
      public function getCategories(){
          return $this->storage['categories'];
      }
       public function getArticles(): array {
        return $this->storage['articles'];
    }
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

  //les methodes
        //1)login
        public function login(string $email,string $password):bool{
             
             foreach($this->storage['users'] as  $st){
                   if($st->getEmail()==$email  && $st->getPassword()==$password ){
                         $this->current_user=$st;
                         return true;
             }
            
            }
                     return false;
        }
        //logout
        public function logout() {
         $this->current_user=null;

}
      public function getCurrentUser() {
           return $this->current_user;
}
     public function isLoggedIn() {
          if($this->current_user!=null){
             return true;
          }else{
              return false;
          }

} 
  //creation de user
      public function ajouter_user(User $user){
           $this->storage['users'][]=$user;
      }
  //supprimer user
     public function supprimer_user_ById(int $id){
          foreach($this->storage['users'] as $key=>$st){
               if($st->getId()==$id)
                unset($this->storage['users'][$key]);
          }
     }
    
    //modifier user
       public function modifier_user(User $user,User $new){
          foreach($this->storage['users'] as $key=>$st){
                 if($st===$user)  
                    $this->storage['users'][$key]=$new;
          }
       } 
    //supprimer articles pour admin et editeur
        public function supprimer_article_BYId(int $id){
             foreach($this->storage['articles'] as $key=>$art){
                 if($art->getId()==$id)
                    unset($this->storage['articles'][$key]);
            }
        }
       //modfier article pour admin et editeur
        public function modifier_article_ID(int $id,Article $newarticle):void{
              foreach($this->storage['articles']  as $art){
                if($art->getId()==$id){
                     $art->setId($newarticle->getId());
                     $art->setTitle($newarticle->getTitle());
                     $art->setContent($newarticle->getContent());
                     $art->setExcerpt($newarticle->getExcerpt());
                     $art->setStatus($newarticle->getStatus());
            
              }
            }
             
        }
        //creer categorie
        public function ajouter_categorie(categorie $cat){
             $this->storage['categories'][]=$cat;
        }
        //suprimer categorie

        public function supprimer_categorie_BYID(int $id) {
            foreach ($this->storage['categories'] as $key => $cat) {
              if ($cat->getId() == $id) {
                unset($this->storage['categories'][$key]);
        }
    }
            foreach ($this->storage['articles'] as $article) {
             $article->supprimerBYID($id);
    }
}

       
        //modifier categorie
public function modifier_categorie(int $id, categorie $newCategorie){
    foreach ($this->storage['categories'] as $cat) {
        if ($cat->getId() === $id) {
            $cat->setName($newCategorie->getName());
            $cat->setDescription($newCategorie->getDescription());
        }
    }
}
    //les statistique pour admin
public function getstatistique(){
         return [
          'users'=>count($this->storage['users']),
           'categories'=>count($this->storage['categories']),
           'articles'=>count($this->storage[ 'articles'])
         ];
     }
    //modifier comment pour editeur et admin
  public function modifier_comment(int $id,string $newcomment){
    foreach ($this->storage['articles'] as $art) {
        foreach ($art->getComment() as $comt) {
         if ($comt->getId() === $id) {
            $comt->setcontent($newcomment);
        }
    
}
}
}




}



    ?>

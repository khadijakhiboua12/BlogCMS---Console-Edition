


<!-- $auteur1=new Auteur("Je suis dev", 1, "auteur", "khadija@gmail.com", "1234");
$auteur2=new Auteur("Backend dev", 2, "auteur", "sami@gmail.com", "abcd");
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
]; -->


<?php
class Collection {
    private static $instance = null;
    private $current_user = null;
    private $storage = [];

    private function __construct() {
        $this->storage = [
          'users' => [new User(1,'khadija','khadija@gmail.com','1234'),
            new Auteur('hh',1,'khadija','khadija@gmail.com','1234'),
            new Editeur('hi',3,'sara','sara@gmail.com','1234'),
            new Admin(true,1,'admin','admin@gmail.com','123')],
            'categories' => [],
            
        ];
       

    }  
    //function de storage
    //    public function getStorage():array{
    //      return $this->storage;
    //    }
    // //function de getuser
    //    public function getUser():array{
    //      return $this->storage['users'];
    //    }

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
  
}
//
    ?>


<?php
class Collection {
    private static $instance = null;
    private $current_user = null;
    private $storage = [];

    private function __construct() {
        $this->storage = [
          'users' => [new User(1,'khadija','khadija@gmail.com','1234'),
            new Auteur('hh',1,'khadija','khadija@gmail.com','1234',[new Article(1,"meths","maths est une bonne ","hid","publier")] ),
            new Editeur('hi',3,'sara','sara@gmail.com','1234'),
            new Admin(true,1,'admin','admin@gmail.com','123')],
            'categories' => [],
            
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

    }
    ?>

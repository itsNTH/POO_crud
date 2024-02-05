<?php   
class User{
    private $prenom;
    private $nom;
    private $password;
    private $email;
    private $bdd;
    
    public function __construct(array $donnees) {
        $this->hydrate($donnees);

    }
    private function getPrenom() {
        return $this->prenom;
    }
    private function getNom() {
        return $this->nom;
    }
    private function getPassword() {
        return $this->password;
    }
    private function getEmail() {
        return $this->email;
    }
    private function setPrenom($prenom) {
        $this->prenom = $prenom;
    }
    private function setNom($nom) {
        $this->nom = $nom;
    }
    private function setPassword($password) {
        $this->password = $password;
    }
    private function setEmail($email) {
        $this->email = $email;
    }

    private function hydrate(array $donnees) {
        foreach ($donnees as $key => $value) {
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }
    
    public function ajouter() {
        $this->bdd = $this->bdd();
        $req = $this->bdd->prepare('INSERT INTO users(prenom, nom, email, password) VALUES(:prenom, :nom, :email, :password)');
        $req->execute(array(
            'prenom' => $this->getNom(),
            'nom' => $this->getPrenom(),
            'email' => $this->getEmail(),
            'password' => $this->getPassword()));
            
            $resultat = $req->fetchAll();
            return $resultat;       
    }
    public function connexion() {
            $this->bdd = $this->bdd();
            $req = $this->bdd->prepare('SELECT * FROM user WHERE email = :email AND password = :password');
            $req->execute(array(
                'email' => $this->email,
                'password' => $this->password
            ));
            $resultat = $req->fetch();
            return $resultat;
            
            
        }
    private function bdd(){
        try
        {
            $bdd = new PDO('mysql:host=localhost;dbname=jdbc;charset=utf8', 'root', '');
            return $bdd;
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
    }   
    private function delete() {
        $this->bdd = $this->bdd();
        $req = $this->bdd->prepare('DELETE FROM users WHERE email = :email' );
        $req->execute(array(
            'email' => $this->email
        ));

    
   
    }
}
    

?>

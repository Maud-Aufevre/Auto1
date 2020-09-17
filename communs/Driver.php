<?php



class Driver{
    private $bd;

    public function __construct($bd){
        $this->bd = $bd;
    }

    public function listCategories(){

        $sql = "SELECT * FROM categorie";
        $res = $this->bd->prepare($sql);
        $res->execute();
        $rows = $res->fetchAll(PDO::FETCH_OBJ);
        //var_dump($rows); die();
        $donnees = [];
   
        foreach($rows as $row){
            $cat  = new Category();

            $cat->setId_cat($row->id_cat);
            $cat->setNom_cat($row->nom_cat);
            $cat->setDate_cat($row->date_created_cat);
            array_push($donnees,$cat);
        }
        return $donnees;

    }

    public function deleteCategory($id){
        $sql = "DELETE FROM categorie WHERE id_cat = ?";
        $res = $this->bd->prepare($sql);
        $res->execute([$id]);
        $nb = $res->rowCount();
        return $nb;
    }

    public function addCategory(Category $cat){
        $sql = "INSERT INTO categorie(nom_cat) VALUES(:nom)";
        $res = $this->bd->prepare($sql);
        $res->execute(['nom'=>$cat->getNom_cat()]);
        return $this->bd->lastInsertId();
    }
    
    public function listVehicule($id = null, $search = null){

        if(!empty($search)){
            
            $sql = "SELECT * FROM vehicule v 
                    INNER JOIN categorie c 
                    ON v.id_cat = c.id_cat
                    WHERE marque LIKE ? OR modele LIKE ? OR pays LIKE ? OR nom_cat LIKE ?";
                    $res = $this->bd->prepare($sql);
                    $tabSearch = ["$search%","$search%","$search%","$search%"];
                    $res->execute($tabSearch);
                   
      
        }else if(!empty($id)){

                $sql = "SELECT*FROM vehicule WHERE id_veh = ?"; 
                $res = $this->bd->prepare($sql);
                $res->execute([$id]);
             

        }else{
            $sql = "SELECT * FROM vehicule";
            $res = $this->bd->prepare($sql);
            $res->execute();
           
        }
        $lines = $res->fetchAll(PDO::FETCH_OBJ);
        

        //var_dump($lines); die();

        $datas = [];

        foreach($lines as $line){
            $veh = new Vehicule();
            $veh->setId_veh($line->id_veh);
            $veh->setMarque($line->marque);
            $veh->setModele($line->modele);
            $veh->setPays($line->pays);
            $veh->setPrix($line->prix);
            $veh->setImage($line->image);
            $veh->setDescription($line->description);
            $veh->setAnnee($line->annee);
            $veh->setDate_veh($line->date_created_veh);
            $veh->setId_cat($line->id_cat);
            $veh->etat = $line->etat;
            array_push($datas,$veh);
        }
        return $datas;
    }

    public function getNameCat($id){

        $sql = "SELECT * FROM categorie WHERE id_cat = ?";
        $res = $this->bd->prepare($sql);
        $res->execute([$id]);
        $data = $res->fetch(PDO::FETCH_OBJ);

        $cat = new Category();
        if($res->rowCount()){
            $cat->setId_cat($data->id_cat);
            $cat->setNom_cat($data->nom_cat);
        }
        return $cat;
    }

    public function addVehicule(Vehicule $veh){

        $sql = "INSERT INTO vehicule(marque, modele, pays, prix, annee, image, description, id_cat)
                VALUES(?,?,?,?,?,?,?,?)";
        $res = $this->bd->prepare($sql);

        $tabParam = [$veh->getMarque(),$veh->getModele(),$veh->getPays(),$veh->getPrix(),$veh->getAnnee(),
        $veh->getImage(),
        $veh->getDescription(),$veh->getId_cat()];

        $res->execute($tabParam);

        return $this->bd->lastInsertId();

    }

    public function deleteVehicule($id){
        $sql = "DELETE FROM vehicule WHERE id_veh = ?";
        $res = $this->bd->prepare($sql);
        $res->execute([$id]);
        return $res->rowCount();
    }

    public function updateVehicule(Vehicule $veh){
        if($veh->getImage() === ""){
            $sql = "UPDATE vehicule
                SET marque=?,modele=?,pays=?,prix=?,annee=?,description=?,id_cat=? 
                WHERE id_veh = ?";
             $tabVeh = [$veh->getMarque(),$veh->getModele(),$veh->getPays(),$veh->getPrix(),$veh->getAnnee(),
             $veh->getDescription(),$veh->getId_cat(),$veh->getId_veh()];
             
        }else{
            $sql = "UPDATE vehicule
                    SET marque=?,modele=?,pays=?,prix=?,annee=?,image=?,description=?,id_cat=? 
                    WHERE id_veh = ?";
            $tabVeh = [$veh->getMarque(),$veh->getModele(),$veh->getPays(),$veh->getPrix(),$veh->getAnnee(),
            $veh->getImage(),$veh->getDescription(),$veh->getId_cat(),$veh->getId_veh()];
        }

        $res = $this->bd->prepare($sql);
        $res->execute($tabVeh);
        return $res->rowCount();
    }

    public function signIn($login,$pass){
        $sql = "SELECT * FROM users WHERE (login = :login OR email = :login) AND pass = :pass";
        $res = $this->bd->prepare($sql);
        $res->execute(['login'=>$login,'pass'=>$pass]);
        if($res->rowCount()){
            $rows = $res->fetch(PDO::FETCH_OBJ);
            if($rows->statut == 1){
                session_start();
                $_SESSION['Auth'] = $rows;
                header('location:listVehicule.php');
                return "";
            }else{
                return "ce compte a été désactivé";
            }
            
        }else{
            return "Identifiant et mot de passe ne correspondent pas";
        }
    }
    public function addUser(User $user){
        $req = "SELECT * FROM users WHERE email =?";
        $res2 = $this->bd->prepare($req);
        $res2->execute([$user->getEmail()]);

        if($res2->rowCount()==0){
            $sql = "INSERT INTO users(nom, prenom, login,email,pass,role)
            VALUES(?,?,?,?,?,?)";
            $tabUser = [$user->getNom(), $user->getPrenom(),$user->getLogin(),$user->getEmail(),$user->getPass(),$user->getRole()];
            $res = $this->bd->prepare($sql);
            $res->execute($tabUser);
            if($this->bd->lastInsertId()){
                header('location:index.php');
                
            }
            return "";
        }else{
            return "utilisateur existe en base...";
        }
    }

    public function listUsers(){

        $sql = "SELECT * FROM users";
        $res = $this->bd->prepare($sql);
        $res->execute();
        $rows = $res->fetchAll(PDO::FETCH_OBJ);
        //var_dump($rows); die();
        $donnees = [];
   
        foreach($rows as $row){
            $user  = new User();

            $user->setId($row->id_user);
            $user->setNom($row->nom);
            $user->setPrenom($row->prenom);
            $user->setLogin($row->login);
            $user->setEmail($row->email);
            $user->setRole($row->role);
            $user->statut = $row->statut;
            array_push($donnees,$user);
        }
        return $donnees;

    }

    public function changeStatut($statut,$id) {
        $sql = "UPDATE users SET statut = ? WHERE id_user = ?";
        $res = $this->bd->prepare($sql);
        $res->execute([$statut,$id]);
        return $res->rowCount();

    }

    public function switchEtat($etat,$id){
        $sql = "UPDATE vehicule SET etat = ? WHERE id_veh = ?";
        $res = $this->bd->prepare($sql);
        $res->execute([$etat,$id]);
        return $res->rowCount();
    }
}

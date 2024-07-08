<?php
namespace App\Models;
use Env\Connexion;
class Client extends Connexion{
    private int $id;
    private string $fk_user;
    private string $nom_famille;
    private string $prenom;
    private ?string $telephone;
    
    public function __construct(int $fk_user = 0, string $nom_famille = "", string $prenom = "", string $telephone = ""){
        $this->fk_user = $fk_user;
        $this->nom_famille = $nom_famille;
        $this->prenom = $prenom;
        $this->telephone = $telephone;
    }

    public function create(){
        $data = [
            "fk_user"=> $this->fk_user,
            "nom_famille"=> $this->nom_famille,
            "prenom"=> $this->prenom,
            "telephone"=> $this->telephone,
        ];
        $msg = "Certains champs sont vides";
        $data = ["id"=>0,"message"=>$msg];
        if(isset($this->fk_user) && isset($this->nom_famille) && isset($this->prenom) && isset($this->telephone)){
            if(!empty($this->fk_user) && !empty($this->nom_famille) && !empty($this->prenom) && !empty($this->telephone)){
                $pdo = $this->ServerConnected();
                $state = $pdo->prepare("INSERT INTO clients(fk_user,nom_famille,prenom,telephone)values(:v1,:v2,:v3,:v4)");
                $state->bindParam(':v1', $this->fk_user);
                $state->bindParam(':v2', $this->nom_famille);
                $state->bindParam(':v3', $this->prenom);
                $state->bindParam(':v4', $this->telephone);
                $state->execute();
                $msg = "Enregistrement réussie avec succès !!";
                $data['id'] = $pdo->lastInsertId();
                $data["message"] = $msg;
            }        
        }     
        return $data;
    }
    public function getAll(){

    }
    public function findById(int $id){

    }

}
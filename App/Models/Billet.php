<?php
namespace App\Models;
use Env\Connexion;

class Billet extends Connexion{
    private int $id;
    private string $nom;
    private int $fk_agence;
    private string $destination;
    private string $date_depart;
    private ?string $description ="";
    private bool $is_disponible = true;
    private int $price;

    public function __construct(string $nom ="", int $fk_agence = 0, string $destination ="", string $date_depart ="",int $price = 0,string $description = "",){
        $this->nom = $nom;
        $this->fk_agence = $fk_agence;
        $this->destination = $destination;
        $this->date_depart = $date_depart;
        $this->description = $description;
        $this->price = $price;
    }

    public function create(){
        $msg = "Enregistrement réussie avec succès";
        if(isset($this->nom) && isset($this->fk_agence)&& isset( $this->destination) && isset( $this->date_depart) && isset($this->price)){
            if(!empty($this->nom) && !empty($this->fk_agence) && !empty( $this->destination) && !empty( $this->date_depart) && !empty($this->price)){
                $data = [
                    "nom"=> $this->nom,
                    "fk_agence"=> $this->fk_agence,
                    "destination"=> $this->destination,
                    "date_depart"=> $this->date_depart,
                    "price"=> $this->price
                ];
                // return $data;
                $pdo = $this->ServerConnected();
                $state = $pdo->prepare("INSERT INTO billets(nom,fk_agence,destination,date_depart,price)values(:v1,:v2,:v3,:v4,:v5)");
                $state->bindParam(':v1', $this->nom);
                $state->bindParam(':v2', $this->fk_agence);
                $state->bindParam(':v3', $this->destination);
                $state->bindParam(':v4', $this->date_depart);
                $state->bindParam(':v5', $this->price);
                $state->execute();
            }
            else{
                $msg = "Certains champs son vides";
            }
        }
        else{
            $msg = "Certains champs ne figure pas dans la condition";
        }
         
        return $msg;
    }
    public function getAll(){
        return $this->select("billets");
    }
    public function findById(int $id){
       return $this->selectById("billets",$id);
    }
}
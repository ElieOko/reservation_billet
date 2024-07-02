<?php
namespace App\Models;
use Env\Connexion;
class PaiementCarte extends Connexion{
    private int $id;
    private string $nom;

    public function __construct(string $nom){
        $this->nom = $nom;
    }
    public function create(){
        $pdo = $this->ServerConnected();
        if(isset($this->nom) && !empty($this->nom)){
            $state = $pdo->prepare("INSERT  INTO paiement_cartes(nom)value(:nom)");
            $state->bindParam(':nom', $this->nom);
            $state->execute();
            return "Success";
        }
    }
    public function getAll(){
        return $this->select("paiement_cartes");
    }
    public function findById(int $id){

    }
}
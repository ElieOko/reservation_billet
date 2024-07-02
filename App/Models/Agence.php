<?php
namespace App\Models;
use Env\Connexion;
class Agence extends Connexion{
    private int $id = 0;
    private string $nom;
    private ?string $description = "";

    public function __construct(string $nom = "", string $description = ""){
        $this->nom = $nom;
        $this->description = $description;
    }
    public function create(){
        $data = ["nom" => $this->nom];
        $pdo = $this->ServerConnected();
        $state = $pdo->prepare("INSERT  INTO agences(nom)value(:nom)");
        $state->bindParam(':nom', $this->nom);
        $state->execute();
        return "Success";
    }
    public function getAll(){
        return $this->select("agences");
    }
    public function findById(int $id){

    }

}
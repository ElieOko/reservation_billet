<?php
namespace App\Models;
class Client{
    private int $id;
    private string $fk_user;
    private string $nom_famille;
    private string $prenom;
    private ?string $telephone;
    
    public function __construct(int $fk_user, string $nom_famille, string $prenom, string $telephone = ""){
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
    }
    public function getAll(){

    }
    public function findById(int $id){

    }

}
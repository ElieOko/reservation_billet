<?php
namespace App\Models;

class Billet{
    private int $id;
    private string $nom;
    private int $fk_agence;
    private string $destination;
    private string $date_depart;
    private ?string $description;
    private bool $is_disponible = true;
    private int $price;

    public function __construct(string $nom, int $fk_agence, string $destination, string $date_depart, string $description = "",$price){
        $this->nom = $nom;
        $this->fk_agence = $fk_agence;
        $this->destination = $destination;
        $this->date_depart = $date_depart;
        $this->description = $description;
        $this->price = $price;
    }

    public function create(){
        $data = [
            "nom"=> $this->nom,
            "fk_agence"=> $this->fk_agence,
            "destination"=> $this->destination,
            "date_depart"=> $this->date_depart,
            "is_disponible"=>$this->is_disponible,
            "description"=> $this->description,
            "price"=> $this->price
        ];
    }
    public function getAll(){

    }
    public function findById(int $id){

    }
}
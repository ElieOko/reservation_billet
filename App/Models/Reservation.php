<?php
namespace App\Models;
class Reservation{
    public const STATUS_APPROUVE = "accepter" ;
    public const STATUS_ATTENTE = "en attente" ;
    public const STATUS_ANNULER = "annuler" ;
    private string $status = "";
    private int $fk_billet;
    private int $fk_client;
    private string $date_reservation;
    private int $fk_paiment_carte;
    
    public function __construct(int $fk_billet, int $fk_client, string $date_reservation, int $fk_paiment_carte){
        $this->fk_billet = $fk_billet;
        $this->fk_client = $fk_client;
        $this->date_reservation = $date_reservation;
        $this->fk_paiment_carte = $fk_paiment_carte;
    }
    public function create(){
        $this->status = self::STATUS_ATTENTE ;
        $this->date_reservation = date("Y-m-d H:i:s");
    }
    public function cancel(int $id){
        
    }
    public function getAll(){

    }
    public function findById(int $id){

    }
}
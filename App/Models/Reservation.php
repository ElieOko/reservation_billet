<?php
namespace App\Models;
use Env\Connexion;
use DateTime;
class Reservation extends Connexion{
    public const STATUS_APPROUVE = "accepter" ;
    public const STATUS_ATTENTE = "en attente" ;
    public const STATUS_ANNULER = "annuler" ;
    private string $status = "en attente";
    private int $fk_billet;
    private int $fk_client;
    private int $place;
    private string $date_reservation;
    private int $fk_paiment_carte;
    
    public function __construct(int $fk_billet = 0, int $fk_client = 0, int $fk_paiment_carte = 0,string $date_reservation = ""){
        $this->fk_billet = $fk_billet;
        $this->fk_client = $fk_client;
        $this->date_reservation = $date_reservation;
        $this->fk_paiment_carte = $fk_paiment_carte;
    }
    public function create(){
        $pdo = $this->ServerConnected();
        $date = date("Y-m-d H:i:s");
        $state = $pdo->prepare("INSERT  INTO reservations(fk_billet,fk_client,date_reservation,fk_paiment_carte,status)value(:fk_billet,:fk_client,:date_reservation,:fk_paiment_carte,:status)");
        $state->bindParam(':fk_billet', $this->fk_billet);
        $state->bindParam(':fk_client', $this->fk_client);
        $state->bindParam(':date_reservation', $date);
        $state->bindParam(':fk_paiment_carte', $this->fk_paiment_carte);
        $state->bindParam(':status', $this->status);
        $state->execute();
        return "Success";
        // $this->status = self::STATUS_ATTENTE ;
        // $this->date_reservation = date("Y-m-d H:i:s");
    }
    public function cancel(int $id){
        
    }
    public function getAll(){
        return $this->select("reservations");
    }
    public function findByFk(int $id){
        return $this->selectByIdClient("reservations", $id);
    }
}
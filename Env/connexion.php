<?php
namespace Env;

use PDO;
use PDOException;
class Connexion{
    private $server = "localhost";
    private $port = 3306;
    private $user = "root";
    private $password = "";
    private $database = "reservation_db";

    public function ServerConnected(){
        try {
            $conn = new PDO(
                "mysql:host=$this->server;port=$this->port;dbname=$this->database",
                "$this->user",
                "$this->password"
            );
            $conn->setAttribute(
                PDO::ATTR_ERRMODE,
                PDO::ERRMODE_EXCEPTION
            );
            return $conn;
        } catch (PDOException $e) {
            echo "". $e->getMessage();
        }
    }
    private function createTableUser(){
        $server = $this->ServerConnected();
        try {
            // $stmt = $server->query("SHOW TABLES utilisateurs");
            $message = "La table 'utilisateurs' existe déjà.";
            // if ($stmt->rowCount() == 0) {
                $sql = "CREATE TABLE utilisateurs (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    username VARCHAR(255) UNIQUE,
                    password VARCHAR(255) NOT NULL,
                    email VARCHAR(255) NULL,
                    is_admin tinyint(1) NOT NULL DEFAULT '0'
                )";
                $server->exec($sql);
                $message = "La table 'utilisateurs' a été créée avec succès.";
            // }
            return $message;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
    private function createTableClient(){
        $server = $this->ServerConnected();
        try {
            // $stmt = $server->query("SHOW TABLES clients");
            $message = "La table 'clients' existe déjà.";
            // if ($stmt->rowCount() == 0) {
                $sql = "CREATE TABLE clients (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    fk_user INT NOT NULL,
                    nom_famille VARCHAR(255) NOT NULL,
                    prenom VARCHAR(255) NOT NULL,
                    telephone VARCHAR(255) NULL
                )";
                $server->exec($sql);
                $message = "La table 'client' a été créée avec succès.";
            // }
            return $message;   
        } catch (\Throwable $th) {
            //throw $th;
            return $th->getMessage();
        }

    }
    private function createTableAgence(){
        $server = $this->ServerConnected();
        try {
            // $stmt = $server->query("SHOW TABLES agences");
            $message = "La table 'agences' existe déjà.";
            // if ($stmt->rowCount() == 0) {
                $sql = "CREATE TABLE agences (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    nom VARCHAR(255) NOT NULL
                )";
                $server->exec($sql);
                $message = "La table 'agences' a été créée avec succès.";
            // }
            return $message;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

    }
    private function createTablePaiementCarte(){
        $server = $this->ServerConnected();
        try {
            // $stmt = $server->query("SHOW TABLES paiement_cartes");
            $message = "La table 'paiement_cartes' existe déjà.";
            // if ($stmt->rowCount() == 0) {
                $sql = "CREATE TABLE IF NOT EXISTS paiement_cartes (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    nom VARCHAR(255) UNIQUE
                )";
                $server->exec($sql);
                $message = "La table 'paiement_cartes' a été créée avec succès.";
            // } 
            return $message; 
        } catch (\Throwable $th) {
            //throw $th;return $th->getMessage();
        }
        
    }
    private function createTableReservation(){
        $server = $this->ServerConnected();
        try {
            // $stmt = $server->query("SHOW TABLES reservations");
            $message = "La table 'reservations' existe déjà.";
            // if ($stmt->rowCount() == 0) {
            $sql = "CREATE TABLE IF NOT EXISTS reservations (
                id INT AUTO_INCREMENT PRIMARY KEY,
                fk_billet INT NOT NULL,
                fk_client INT NOT NULL,
                fk_paiment_carte INT NOT NULL,
                status VARCHAR(13) NOT NULL,
                date_reservation VARCHAR(30) NOT NULL
            )";
            $server->exec($sql);
            $message = "La table 'reservations' a été créée avec succès.";
        // } 
        return $message;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
        
    }
    private function createTableBillet(){
        $server = $this->ServerConnected();
        try {
            //$stmt = $server->query("SHOW TABLES billets");
            $message = "La table 'billets' existe déjà.";
            // if ($stmt->rowCount() == 0) {
                $sql = "CREATE TABLE IF NOT EXISTS billets (
                    id INT AUTO_INCREMENT PRIMARY KEY,
                    fk_agence INT NOT NULL,
                    nom VARCHAR(50) NOT NULL,
                    destination VARCHAR(50) NOT NULL,
                    price INT NOT NULL,
                    description VARCHAR(255) NULL,
                    date_depart VARCHAR(30) NOT NULL
                )";
                $server->exec($sql);
                $message = "La table 'billets' a été créée avec succès.";
            //} 
            return $message;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }

    }
    public function migrationTable(){
        $state_ = $this->createTableAgence();
        $state2 = $this->createTableBillet();
        $state3 = $this->createTableClient();
        $state4 = $this->createTablePaiementCarte();
        $state5 = $this->createTableReservation();
        $state6 = $this->createTableUser();
        return [
            "messages "=>"$state_|$state2|$state3|$state4|$state5|$state6"
        ];
    }
    public function select($tableName){
        try {
            $query = "SELECT * FROM $tableName";
            $server = $this->ServerConnected();
            $result = $server->query($query);
            return $result;
        } catch (\Throwable $th) {
            //throw $th;
        }  
    }
    public function selectByIdClient($tableName,$id){
        try {
            $query = "SELECT * FROM $tableName where fk_client=$id";
            $server = $this->ServerConnected();
            $result = $server->query($query);
            return $result;
        } catch (\Throwable $th) {
            //throw $th;
        }  
    }
    public function selectById($tableName,$id){
        try {
            $query = "SELECT * FROM $tableName where id=$id";
            $server = $this->ServerConnected();
            $result = $server->query($query);
            return $result;
        } catch (\Throwable $th) {
            //throw $th;
        }  
    }
    public function dropTable($tableName){
        // Prepare the SQL statement
        $server = $this->ServerConnected();
        $sql = "DROP TABLE IF EXISTS $tableName";
        $server->exec($sql);
    }
        
    public function deleteAll(){
        $this->dropTable("utilisateurs");
        // $this->dropTable("paiement_cartes");
        // $this->dropTable("agences");
        // $this->dropTable("billets");
        // $this->dropTable("clients");
        // $this->dropTable("reservations");
    }
}

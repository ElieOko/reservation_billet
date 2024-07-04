<?php
namespace App\Models;
use Env\Connexion;
class User extends Connexion{
    private int $id;
    private string $username;
    private ?string $email;
    private string $password;
    private bool $is_admin = true;
    public function __construct(string $username,string $password,string $email =""){
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }
    public function save() : string {
        if(isset($this->username) && isset($this->email) && isset($this->password)){
            if(!empty($this->username) && !empty($this->email) && !empty($this->password)){
                $data = [
                    "username"=>$this->username,
                    "email"=>$this->email,
                    "password"=>$this->password,
                    "is_admin"=>$this->is_admin
                ];
                $pdo = $this->ServerConnected();
                $state = $pdo->prepare("INSERT INTO utilisateurs(username,email,password,is_admin)values(:v1,:v2,:v3,:v4)");
                $state->bindParam(':v1', $this->username);
                $state->bindParam(':v2', $this->email);
                $state->bindParam(':v3', $this->password);
                $state->bindParam(':v4', $this->is_admin);
                $state->execute();
            }
            
        }     
        return $this->id;
    }
    public function login() : int {
        return $this->id;
    }
    public function getAll(){

    }
    public function findById(int $id){

    }
}
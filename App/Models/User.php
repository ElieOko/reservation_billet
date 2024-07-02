<?php
namespace App\Models;
class User{
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
            }
            else{

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
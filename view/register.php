<?php

include("../Env/connexion.php");
include("../App/Models/User.php");
include("../App/Models/Client.php");

use App\Models\Client;
use App\Models\User;
session_start();

if (isset($_POST["save"])) {
   if (
    isset($_POST["nom_famille"]) && 
    isset($_POST["prenom"]) &&
    isset($_POST["telephone"]) &&
    isset($_POST["username"]) &&
    isset($_POST["password"])) {
      if(
        !empty($_POST["nom_famille"]) && 
        !empty($_POST["prenom"]) &&
        !empty($_POST["telephone"]) &&
        !empty($_POST["username"]) &&
        !empty($_POST["password"])) {
          $user = new User($_POST["username"],$_POST["password"]);
          $data = $user->create();
          if($data['id']!= 0){
            $client = new Client($data['id'],$_POST["nom_famille"],$_POST["prenom"],$_POST["telephone"]);
            $state = $client->create();
            if($state['id']!=0){
              $_SESSION['user_id'] = $data['id'];
              $_SESSION['client_id'] = $state['id'];
              header("Location:index.php");
            }
          }
        }
   }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <script src="../assets/js/tailwindcss.js"></script>
</head>
<body class="">
<div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-md">
    <h2 class="mt-6 text-center text-2xl font-bold leading-9 tracking-tight text-blue-300">Créer votre compte sur KC-Travel</h2>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-[480px]">
    <div class="bg-white px-6 py-12 shadow sm:rounded-lg sm:px-12">
      <form class="space-y-6" action="register.php" method="POST">
      <div>
          <label for="nom_famille" class="block text-sm font-medium leading-6 text-gray-900">Nom de famille</label>
          <div class="mt-2">
            <input id="nom_famille" name="nom_famille" type="text"  required class="block w-full rounded-md border-0  py-1.5 p-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
          </div>
      </div> 
      <div>
          <label for="prenom" class="block text-sm font-medium leading-6 text-gray-900">Prenom</label>
          <div class="mt-2">
            <input id="prenom" name="prenom" type="text"  required class="block w-full rounded-md border-0  py-1.5 p-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
          </div>
      </div> 
      <div>
          <label for="telephone" class="block text-sm font-medium leading-6 text-gray-900">Téléphone</label>
          <div class="mt-2">
            <input id="telephone" name="telephone" type="tel" placeholder="ex:+242065029934"  required class="block w-full rounded-md border-0  py-1.5 p-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
          </div>
      </div> 
        <div>
          <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Nom d'utilisateur</label>
          <div class="mt-2">
            <input id="username" name="username" type="text"  required class="block w-full rounded-md border-0  py-1.5 p-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
          </div>
        </div> 

        <div>
          <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Mot de passe</label>
          <div class="mt-2">
            <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full rounded-md border-0 py-1.5 p-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
          </div>
        </div>
        <div>
          <button name="save" type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">S'enregister</button>
        </div>
      </form>
    </div>
  </div>
</div>
</body>
</html>
<?php
use Env\Connexion;
use App\Models\PaiementCarte;
include("../../Env/connexion.php");
include("../../App/Models/PaiementCarte.php");
session_start();

$msg ="";
if(isset($_POST["save"])){
    $msg = "Certains champs sont vides";
    if(isset($_POST["nom"])){
        if(!empty($_POST["nom"])){
            $carte = new PaiementCarte($_POST["nom"]);  
            $msg = $carte->create();
        }
    }
 
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../../assets/js/tailwindcss.js"></script>
    <title>Ajout Agence</title>
</head>
<body>
<div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8">
  <div class="sm:mx-auto sm:w-full sm:max-w-md">
    <h2 class="mt-6 text-center text-2xl font-bold leading-9 tracking-tight text-blue-300">Ajouter une nouvelle carte de paiement</h2>
  </div>

  <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-[480px]">
  <div class="rounded-md bg-green-50 p-4 mb-8 ">
                    <div class="flex">
                        <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                        </svg>
                        </div>
                        <div class="ml-3">
                            <?php if($msg != ""):?>
                                <h3 class="text-sm font-medium text-green-800"><?php
                                    var_dump($msg);
                                    ?></h3>
                            <?php endif?>
                        </div>
                    </div>
  </div>
    <div class="bg-white px-6 py-12 shadow sm:rounded-lg sm:px-12">
      <form class="space-y-6" action="index.php" method="POST">
        
      <div>
          <label for="nom" class="block text-sm font-medium leading-6 text-gray-900">Nom de la carte</label>
          <div class="mt-2">
            <input id="nom" name="nom" type="text"  required class="block w-full rounded-md border-0  py-1.5 p-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
          </div>
      </div> 
        <div>
          <button name="save" type="submit" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Sauvegarder</button>
        </div>
      </form>
    </div>
  </div>
</div> 
</body>
</html>
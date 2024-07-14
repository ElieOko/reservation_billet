<?php
use App\Models\Billet;
use App\Models\PaiementCarte;
include("../Env/connexion.php");
include("../App/Models/User.php");
include("../App/Models/Client.php");
include("../App/Models/Reservation.php");
include("../App/Models/Billet.php");
include("../App/Models/PaiementCarte.php");
use App\Models\Client;
use App\Models\Reservation;
use App\Models\User;
session_start();

$client = new Client();
$reservation = new Reservation();
$billet = new Billet();
$message = "";
$carte_paiement = new PaiementCarte();
if (isset($_SESSION["user_id"])) :
  $pull_data = $client->findByFk($_SESSION['user_id']);
  if($pull_data){ 
    $data = $reservation->findByFk($pull_data->fetch()['id']);
}  
if(isset($_POST["cancel"])){
  if(!empty($_POST["date_reservation"]) && !empty($_POST["reservation_id"])){
    $message = $reservation->cancel($_POST['date_reservation'],$_POST['reservation_id']);
  }
  else{
   $message = "Les champs requises sont vides";  
  }

} 
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <script src="../assets/js/tailwindcss.js"></script>
</head>
<body>

<div class="container mx-auto px-4 sm:px-6 lg:px-8 mt-8">
<a href="index.php" name="cancel" class="hidden rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:block w-[71px]" >Retour</a>
<div class="border-b border-gray-200 pb-5">
  <h3 class="text-base font-semibold leading-6 text-gray-900">Profil de reservation Client</h3>
  <p class="mt-2 max-w-4xl text-sm text-gray-500">Voir toutes les reservations que vous aviez encours et recents.</p>
</div>
<?php if($message != ""):?>
<div class="rounded-md bg-green-50 p-4 mb-8 ">
        <div class="flex">
                        <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                        </svg>
                        </div>
                        <div class="ml-3">
                            
                                <h3 class="text-sm font-medium text-green-800">
                                  <?=$message?>
                                </h3>
                                <div class="mt-2 text-sm text-green-700">
                                    <p>Une fois la reservation valider vous ne pouviez-plus annuler la reservation après les 48h soit 2jours</p>
                                </div>
                           
                        </div>
                    </div>
            </div>
                <?php endif?>
<ul role="list" class="divide-y divide-gray-100">
  <?php  
     while($item = $data->fetch()) :
    ?>
    <form action="" method="post">
  <li class="flex items-center justify-between gap-x-6 py-5">
    <div class="min-w-0">
      <div class="flex items-start gap-x-3">
        <p class="text-sm font-semibold leading-6 text-gray-900">Destination :<?=($billet->findById($item['fk_billet']))->fetch()['destination']?></p>
        <p class="mt-0.5 whitespace-nowrap rounded-md bg-yellow-50 px-1.5 py-0.5 text-xs font-medium text-yellow-800 ring-1 ring-inset ring-yellow-600/20"><?=$item['status']?></p>
      </div>
      <div class="mt-1 flex items-center gap-x-2 text-xs leading-5 text-gray-500">
        <p class="whitespace-nowrap">Date de reservation <time datetime="2023-06-10T00:00Z"><?=$item['date_reservation']?></time></p>
        <svg viewBox="0 0 2 2" class="h-0.5 w-0.5 fill-current">
          <circle cx="1" cy="1" r="1" />
        </svg>
        <p class="truncate">Client <?=($client->findById($item['fk_client']))->fetch()["nom_famille"]?></p> <br>
        <span class="font-bold">Carte de paiement: <?=($carte_paiement->findById($item['fk_paiment_carte']))->fetch()["nom"]?></span>
      </div>
    </div>
    <div class="flex flex-none items-center gap-x-4">
      <input type="hidden" name="date_reservation" value="<?=$item['date_reservation']?>">
      <input type="hidden" name="reservation_id" value="<?=$item['id']?>">
      <input type="submit" name="cancel" class="hidden rounded-md bg-white px-2.5 py-1.5 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:block" value="Annuler"/>
    </div>
  </li>
  </form>
  <?php endwhile ?>
</ul>
</div>



</body>
</html>
<?php else: ?>
  <div>
      <h1>Session non valide</h1>
  </div>
<?php endif ?>
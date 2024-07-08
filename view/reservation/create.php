<?php
use App\Models\Reservation;
include("../../Env/connexion.php");
include("../../App/Models/Agence.php");
include("../../App/Models/Billet.php");
include("../../App/Models/PaiementCarte.php");
include("../../App/Models/Reservation.php");
use App\Models\Agence;
use App\Models\Billet;
session_start();
$billet = new Billet();
$billet_detail = [];
$agence_ = new Agence();
$billet_all = $billet->getAll();
if(isset($_GET['billet']) && !empty( $_GET['billet'] )){
$billet_detail = $billet->findById($_GET['billet']) ;

    if(isset($_POST['save'])){
        if(isset($_POST['fk_paiment_carte'])){
            if(!empty($_POST['fk_paiment_carte'])){
                if(isset($_SESSION['client_id'])){
                    $reservation = new Reservation($_GET['billet'],$_SESSION['client_id'],$_POST['fk_paiment_carte']);
                    $msg = $reservation->create();
                    
                }
            
            }
        }
}
}

var_dump($msg);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../../assets/js/tailwindcss.js"></script>
    <title>Create reservation billet</title>
</head>
<body>

<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-3xl py-6">
            <form action="create.php" method="post">
            <div class="rounded-md bg-green-50 p-4 mb-8 ">
                    <div class="flex">
                        <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                        </svg>
                        </div>
                        <!-- <div class="ml-3">

                           
                        </div> -->
                    </div>
                </div>
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
                                <div class="mt-2 text-sm text-green-700">
                                    <p>Une fois la reservation valider vous ne pouviez-plus annuler la reservation après les 48h soit 2jours</p>
                                </div>
                            <?php endif?>
                        </div>
                    </div>
                </div>
                <div class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-white shadow">
                    <div class="px-4 py-5 sm:px-6">
                    <div class="px-4 py-5 sm:p-6">
                    <div class="mb-4">
                    <label for="number_billet" class="block text-sm font-medium leading-6 text-gray-900">Nombre de billet</label>
                    <div class="mt-2">
                        <input id="number_billet" name="number_billet" type="number" min="1" class="block w-full rounded-md border-0  py-1.5 p-4 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                    <label for="fk_paiment_carte" class="block text-sm font-medium leading-6 text-gray-900">Mode de paiement</label>
                    <select id="fk_paiment_carte" name="fk_paiment_carte" class="mt-2 block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-900 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-indigo-600 sm:text-sm sm:leading-6">
                        <?php while ($item = $billet_all ->fetch()): ?>
                            <option value="<?=$item['id']?>"><?=$item["nom"]?></option>
                        <?php endwhile?>
                        </select>
                    </div>
                    </div>
                    <div class="px-4 py-4 sm:px-6">
                        <button type="submit"  name="save" class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Confirmer</button>
                    </div>
                </div>
            </form> 
        </div>    
</div>  
</body>
</html>

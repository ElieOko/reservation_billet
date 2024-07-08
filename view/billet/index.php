<?php
include("../../Env/connexion.php");
include("../../App/Models/Agence.php");
include("../../App/Models/Billet.php");
use App\Models\Agence;
use App\Models\Billet;
session_start();

$billet = new Billet();
$data_billet = $billet->getAll();
$agence_ = new Agence();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../../assets/js/tailwindcss.js"></script>
    <title>Billet</title>
</head>
<body>
<div class="bg-white py-24 sm:py-32">
  <div class="mx-auto max-w-7xl px-6 lg:px-8">
    <div class="mx-auto max-w-4xl sm:text-center">
      <h2 class="text-base font-semibold leading-7 text-indigo-600">Billet</h2>
      <p class="mt-2 text-4xl font-bold tracking-tight text-gray-900 sm:text-5xl">Tout les billets</p>
    </div>
    <p class="mx-auto mt-6 max-w-2xl text-lg leading-8 text-gray-600 sm:text-center"></p>
    <div class="mt-20 flow-root">
      <div class="isolate -mt-16 grid max-w-sm grid-cols-1 gap-y-16 divide-y divide-gray-100 sm:mx-auto lg:-mx-8 lg:mt-0 lg:max-w-none lg:grid-cols-3 lg:divide-x lg:divide-y-0 xl:-mx-4">
        <?php
          while($item = $data_billet->fetch()):
        ?>
        <div class="pt-16 lg:px-8 lg:pt-0 xl:px-14">
          <h3 id="tier-basic" class="text-base font-semibold leading-7 text-gray-900">Basic</h3>
          <p class="mt-6 flex items-baseline gap-x-1">
            <span class="text-5xl font-bold tracking-tight text-gray-900"><?=$item['price']?>fcfa</span>
            <span class="text-sm font-semibold leading-6 text-gray-600">/personne</span>
          </p>
          <p class="mt-3 text-sm leading-6 text-gray-500">Agence : <span class="font-bold"><?=($agence_->findById($item['fk_agence']))->fetch()["nom"]?></span></p>
          <a href="../reservation/create.php?billet=<?=$item['id']?>" aria-describedby="tier-basic" class="mt-10 block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Reservez</a>
          <ul role="list" class="mt-6 space-y-3 text-sm leading-6 text-gray-600">
            <li class="flex gap-x-3">
              <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
              </svg>
              Destination :<?=$item['destination']?>
            </li>
            <li class="flex gap-x-3">
              <svg class="h-6 w-5 flex-none text-green-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
              </svg>
              Date de depart :<?=$item['date_depart']?>
            </li>
          </ul>
        </div>
        <?php endwhile?>
      </div>
    </div>
  </div>
</div> 
</body>
</html>
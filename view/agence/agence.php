<?php
include("../../Env/connexion.php");
require("../../App/Models/Agence.php");
use App\Models\Agence;
use Env\Connexion;
$agence = new Agence();
$data = $agence->getAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="../../assets/js/tailwindcss.js"></script>
</head>
<body class="bg-gray-900">
<div class="bg-gray-900 py-24 sm:py-32">
  <div class="mx-auto max-w-7xl px-6 lg:px-8">
    <div class="-mx-6 grid grid-cols-2 gap-0.5 overflow-hidden sm:mx-0 sm:rounded-2xl md:grid-cols-3">
      <?php while ($item = $data->fetch()): ?>
      <div class="bg-white/5 p-8 sm:p-10">
        <h1 class="text-3xl text-white"><?=$item['nom']?></h1>
      </div>
      <?php endwhile?>
    </div>
  </div>
</div>
</body>
</html>
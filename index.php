<?php

require_once('./php/function.php');

try {

  $connexion = new PDO("mysql:host=localhost;dbname=data" ,"baptiste", "baptiste");
  $connexion->exec('SET NAMES utf8'); 

  $query = "SELECT * FROM data ";
  $requete = $connexion->prepare($query);
  $requete->execute();

  $items = $requete->fetchall();

} 

catch(PDOException $e){
  echo 'Echec : ' .$e->getMessage();
}

// Initialisation 
require_once("./php/item.php");

session_start();

if (isset($_POST['add'])){


          $item_array = array(
              'item_id' => $_POST['item_id']
          );

          try {

            $connexion = new PDO("mysql:host=localhost;dbname=data" ,"baptiste", "baptiste");
            $connexion->exec('SET NAMES utf8'); 
          
            $query = "INSERT INTO cart(item_id) VALUES ('" . $_POST['item_id'] . "');";
            $requete = $connexion->prepare($query);
            $requete->execute();
          
          } 
          
          catch(PDOException $e){
            echo 'Echec : ' .$e->getMessage();
          }
      
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="MainD4G" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style/indexStyle.css">
  <title>D4G</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <!--Font awsome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>


<body>


  <?php require_once("php/header.php")?>


  <main>
    <div class="Main_H">
      <div class="Main_Titre">Projet Design4Green 2021</div>
      <div class="Main_Texte">Ce site comprends toutes les bonnes actions que vous pouvez réaliser afin d'améliorer votre projet. Vous pouvez selectionner la bonne action que vous voulez puis l'ajouter au panier. Une fois dans le panier, vous pourrez générer un PDF qui vous servira de feuille de route afin de rendre votre projet plus éco-responsable. </div>
    </div>
    <div class="container">
      <div class="row text-center">
      <?php foreach($items as $item){

        item($item['Famille Origine'], $item['CRITERES'], $item['ID']);

      } ?>
      </div>
    </div>

  </main>

  

  <footer>
    <h4><center>Projet réaliser par Benjamin Brunelliere, Belgacem Dahrouch et Baptiste ODO</center></h4>
  </footer>
</body>
</html>
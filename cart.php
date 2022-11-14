<?php
require_once('./php/function.php');

session_start();

try {

  $connexion = new PDO("mysql:host=localhost;dbname=data" ,"baptiste", "baptiste");
  $connexion->exec('SET NAMES utf8'); 

  if (isset($_POST['supp_item'])) {
    $query = "DELETE FROM cart WHERE item_id='" . $_POST['supp_item'] . "';";
    $requete = $connexion->prepare($query);
    $requete->execute();
    
  }

  $query = "SELECT * FROM cart JOIN data ON cart.item_id=data.ID";
  $requete = $connexion->prepare($query);
  $requete->execute();

  $items = $requete->fetchall();


} 

catch(PDOException $e){
  echo 'Echec : ' .$e->getMessage();
}

  require_once("php/item.php");


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="MainD4G" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style/cartStyle.css">
  <title>cart</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <!--Font awsome-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body>

<?php require_once("php/header.php")?>

<div class=\"contrainer-fluid\">
  <div class=\"row px-5\">
    <div class=\"col-md-7\">
      <div class=\"shopping-cart\">
        <hr>
        <?php 

          if(count($items)>0){
              foreach($items as $item){
                  cartItem($item['Famille Origine'], $item['CRITERES'], $item['ID']);
              }
            }else{
            echo "<h5>Le panier est vide</h5>";
          }

        ?>
      </div>
    </div>
    <div class=\"col-md-5\"></div>
  </div>
</div>



  
</body>
</html>
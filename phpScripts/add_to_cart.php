<?php


if(isset($_GET['cartItems'])){
  $cartItems = $_GET['cartItems'];
  foreach($cartItems as $items){
    $cart_query = 
    "SELECT plante.*,category.category_name
    FROM plante
    JOIN category
    ON plante.category_id = category.id
    AND 
    plante.plant_id = ($items)";
  }
}else{

}

if(isset($_POST['plant_id']) && isset($_POST['user_id'])){

  $userID = $_POST['user_id'];
  $plantID = $_POST['plant_id'];

  include "./dbconnect.php";

  $search_query = "SELECT * FROM panier";
  $result = $conn->query($search_query);

  if($rows = $result->fetch_assoc()){

    if($userID = $rows['userID']){
      $panier = $rows['id'];
    }

  }else{

    $addCart_query = 
    "INSERT INTO panier 
    VALUES('', $userID)";
    $result = $conn->query($addCart_query);
  
  }

}else{
  header('location: ../authentification.php');
}
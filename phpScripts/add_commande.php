<?php

  if(isset($_POST['user_id']) && isset($_POST['payementmethod'])){

    $payementMethod = $_POST['payementmethod'];
    $userID = $_POST['user_id'];

    include "./dbconnect.php";

    $query = 
    "SELECT planteID FROM panierxplante
    WHERE panierID = (SELECT id FROM panier WHERE userID = $userID)";

    $result = $conn->query($query);

    while($rows = $result->fetch_assoc()){

      $plantID = $rows['planteID'];
      
      $fill_commande_query = 
      "INSERT INTO commande 
      VALUES('', $userID, $plantID, '$payementMethod')";
      $fill_result = $conn->query($fill_commande_query);
      

    }

    $delete_query = 
    "DELETE FROM panierxplante
    WHERE panierID = (SELECT id FROM panier WHERE userID = $userID)";
    $delete_result = $conn->query($delete_query);

    header('location: ../Client_page.php?user_id='.$userID);

    die();

  }else{
    header('location: ../authentification.php');
  }

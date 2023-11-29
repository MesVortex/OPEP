<?php

  if(isset($_POST['plant_id']) && isset($_POST['user_id'])){

    $userID = $_POST['user_id'];
    $plantID = $_POST['plant_id'];

    include "./dbconnect.php";

    $delete_query = 
    "DELETE FROM panierxplante
    WHERE panierID = (SELECT id FROM panier WHERE userID = $userID)
    AND
    planteID = $plantID" ;
    $delete_result = $conn->query($delete_query);

    header('location: ../Client_page.php?user_id='.$userID);

    die();

  }else{
    header('location: ../authentification.php');
  }
<?php

  if(isset($_POST['plant_id']) && isset($_POST['user_id'])){

    $userID = $_POST['user_id'];
    $plantID = $_POST['plant_id'];

    include "./dbconnect.php";

    $search_query = "SELECT * FROM panier";
    $result = $conn->query($search_query);
    $i = 0;

    while($rows = $result->fetch_assoc()){
      if($userID === $rows['userID']){
        $panier = $rows['id'];
        $i++;
      }
    }

    if($i === 0){
        $addCart_query = 
        "INSERT INTO panier 
        VALUES('', $userID)";
        $result = $conn->query($addCart_query);
    }

    if($panier){
      $fill_cart_query = 
      "INSERT INTO panierxplante 
      VALUES('', $panier, $plantID)";
      $fill_result = $conn->query($fill_cart_query);

    }
    
    header('location: ../Client_page.php?user_id='.$userID);

    die();

  }else{
    header('location: ../authentification.php');
  }
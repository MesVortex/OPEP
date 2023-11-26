<?php

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  if(!empty($_POST['newName']) && !empty($_POST['category_id']) && !empty($_POST['user_id'])){
    $newName = $_POST['newName'];
    $category_id = $_POST['category_id'];
    $user_id = $_POST['user_id'];

    include "./dbconnect.php";

    $update_query = "UPDATE category SET category_name = ? WHERE id = ?";
    $stmt = $conn->prepare($update_query);
    $stmt->bind_param('si', $newName, $category_id);
    $stmt->execute();

    header('location: ../categories.php?user_id='.$user_id);

    die();

  }else{
    if(!empty($_POST['user_id'])){
      $user_id = $_POST['user_id'];
      header('location: ../categories.php?user_id='.$user_id);
    }else{
      header('location: ../authentification.php');
    }
  }
}else{
  header('location: ../authentification.php');
}

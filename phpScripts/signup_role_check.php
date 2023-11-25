<?php

// prevent access from url
if($_SERVER["REQUEST_METHOD"] == "POST"){

  $role = $_POST['userRole'];

  // connection and access to last row id
  include "./dbconnect.php";
  
  $select_query = "SELECT user_id FROM user ORDER BY user_id DESC LIMIT 1";

  $stmt = $conn->prepare($select_query);
  $stmt->execute();
  
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();

  $curr_userID = $row['user_id'];

  // test if client or admin
  if($role == 'Client'){
    
    $update_query = "UPDATE user SET user_role = ? WHERE user_id = ?";
    $userRole = 2;

    $stmt = $conn->prepare($update_query);

    $stmt->bind_param('ii',$userRole,$curr_userID);
    $stmt->execute();
    $stmt->close();

    header('location: ../authentification.php');

    die();

  }else{

    $update_query = "UPDATE user SET user_role = ? WHERE user_id = ?";
    $userRole = 1;

    $stmt = $conn->prepare($update_query);

    $stmt->bind_param('ii',$userRole,$curr_userID);
    $stmt->execute();
    $stmt->close();

    header('location: ../authentification.php');

    die();

  }
}else{
  header('location: ../sign_up.php');
}
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  if(!empty($_POST['categoryName']) && !empty($_POST['user_id'])){
    $newName = $_POST['categoryName'];
    $user_id = $_POST['user_id'];

    try{
      include "./dbconnect.php";

      $insert_query = 'INSERT INTO category VALUES("", ?)';
      
      $stmt = $conn->prepare($insert_query);
      $stmt->bind_param('s',$newName);
      $stmt->execute();

      header('location: ../categories.php?user_id='.$user_id);

      die();

    } catch (mysqli_sql_exception $e) {
      die("query failed: " . $e->getMessage());
    }
  }else{

    $user_id = $_POST['user_id'];
    header('location: ../categories.php?user_id='.$user_id);

  }
}else{
  header('location: ../authentification.php');
}
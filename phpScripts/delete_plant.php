<?php

if(!empty($_POST['plant_id'])){

  $user_id = $_POST['user_id'];
  $plant_id = $_POST['plant_id'];

  include './dbconnect.php';

  $query = "DELETE FROM plante WHERE plant_id = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param('i', $plant_id);
  $stmt->execute();

  header('location: ../plants.php?user_id='.$user_id);

  die();

}else{

  $user_id = $_POST['user_id'];
  header('location: ../plants.php?user_id='.$user_id);

}

<?php

function check_role($id){

  include "./dbconnect.php";

  $query = "SELECT user_role FROM user WHERE user_id = $id";
  $result = $conn->query($query);
  $user_row = $result->fetch_assoc();

  if($user_row['user_role'] == 1){

    header('location: ../Admin_page.php?user_id='.$id);

    die();

  }else{
    header('location: ../Client_page.php?user_id='.$id);

    die();
  }
  
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
  if(!empty($_POST['email']) && !empty($_POST['pwd'])){
    
    $Email = $_POST['email'];
    $Password = $_POST['pwd'];

    include "./dbconnect.php";

    $query = "SELECT Email,Password,user_id FROM user";
    $result = $conn->query($query);

    while($rows = $result->fetch_assoc()){
      if($rows['Email'] == $Email){
        if($rows['Password'] == $Password){
          check_role($rows['user_id']);
        }
      }
    }

    header('location: ../authentification.php');

    die();

  }else{
    header('location: ../authentification.php');
  }
}else{
  header('location: ../authentification.php');
}


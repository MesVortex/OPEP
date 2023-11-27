<?php

if(!empty($_POST['plantName']) && !empty($_POST['plant_price']) && ($_POST['category_id'] !== 'Select Plant Category') && !empty($_FILES['imageFile'])){
  
  include './dbconnect.php';

  $user_id = $_POST['user_id'];
  $plant_name = $_POST['plantName'];
  $plant_category = $_POST['category_id'];
  $plant_price = $_POST['plant_price'];


  $img_name = $_FILES['imageFile']['name'];
  $img_size = $_FILES['imageFile']['size'];
  $tmp_name = $_FILES['imageFile']['tmp_name'];
  $error = $_FILES['imageFile']['error'];

// image validation
  if($error === 0){
    if($img_size > 10000000){

      $err_msg = 'File is too large, Must be less than 10MB';
      header('location: ../plants.php?user_id='.$user_id.'&error='.$err_msg);    

    }else{
      $img_extention = pathinfo($img_name, PATHINFO_EXTENSION);
      $lowerCaseImgExtention = strtolower($img_extention);

      $allowedTypes = ['jpg', 'png', 'jpeg'];

      if(in_array($lowerCaseImgExtention, $allowedTypes)){

        $new_img_name = uniqid('IMG-', true).'.'.$lowerCaseImgExtention;
        $img_local_path = '../images/'.$new_img_name;
        move_uploaded_file($tmp_name, $img_local_path);

        // db Insertion

        $query = "INSERT INTO plante VALUES ('', ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param('siis', $plant_name, $plant_price, $plant_category, $new_img_name);
        $stmt->execute();

        header('location: ../plants.php?user_id='.$user_id);

        die();

      }else{

        $err_msg = 'Image type not allowed!';
        header('location: ../plants.php?user_id='.$user_id.'&error='.$err_msg);    
      }
      
    }
  }else{

    $err_msg = 'unknown error';
    header('location: ../plants.php?user_id='.$user_id.'&error='.$err_msg);    
  }


}else{

  $user_id = $_POST['user_id'];
  header('location: ../plants.php?user_id='.$user_id);
  
}
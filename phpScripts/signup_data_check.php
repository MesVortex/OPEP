<?php

if($_SERVER["REQUEST_METHOD"] == "POST"){
  if(!empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['email']) && !empty($_POST['pwd'])){
    $First_Name = $_POST['firstName'];
    $Last_Name = $_POST['lastName'];
    $Email = $_POST['email'];
    $Password = password_hash($_POST['pwd'], PASSWORD_DEFAULT);

    try {
      include "./dbconnect.php";

      $select_query = "SELECT Email FROM user WHERE Email = ?";

      $stmt = $conn->prepare($select_query);
      $stmt->bind_param('s',$Email);
      $stmt->execute();
      
      $result = $stmt->get_result();

      if(($curr_email = $result->fetch_assoc()) > 0){

        header("location: ../sign_up.php?error=accountexist");

        die();

      }else{

        $query = "INSERT INTO user(user_FirstName, user_Lastname, Email, Password) VALUES (?, ?, ?, ?)";

        $stmt = $conn->prepare($query);
  
        $stmt->bind_param("ssss",$First_Name,$Last_Name,$Email,$Password);
        $stmt->execute();
        $stmt->close();
  
        header("location: ../role_selection.php");

        die();
        
      }
    

      die();

    } catch (mysqli_sql_exception $e) {
      die("query failed: " . $e->getMessage());
    }
  }else{
    header("location: ../sign_up.php?error=empty");
  }
}else{
  header("location: ../sign_up.php");
}
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Opep Admin Page</title>
  <link rel="stylesheet" href="./css/admin-style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
      integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
</head>
<body>
  <section class="menu-section">
    <div class="border-bottom rounded">
      <div class=" mx-auto | img-box">
        <img class="" src="./images/logo-removebg-preview.png" alt="">
      </div>
    </div>
    <div class="d-flex align-items-center border-bottom rounded">
      <div class="my-3 ms-2">
        <img class="" src="./images/profile-icone.png" alt="">
      </div>
      <?php
        include "./phpScripts/dbconnect.php";
        if(isset($_GET['user_id'])){
          $user_id = $_GET['user_id'];

          $query = "SELECT * FROM user WHERE user_id=?";
          $stmt = $conn->prepare($query);
          $stmt->bind_param('i',$user_id);
          $stmt->execute();
          $result = $stmt->get_result();
          $user_row = $result->fetch_assoc();

          echo '<p class="ms-3 text-white">'.$user_row['user_FirstName'].' '.$user_row['user_Lastname'].'</p>';
        }
      ?>
    </div>
    <div class="list-group list-group-flush">
      <a href="#" class="list-group-item bg-transparent rounded text-white">DASHBOARD <span class="ms-2 fa-solid fa-caret-right" style="color: #ffffff;"> </span></a>
      <?php
        if(isset($_GET['user_id'])){
          $user_id = $_GET['user_id'];
          echo '<a href="./categories.php?user_id='.$user_id.'" class="list-group-item bg-transparent rounded text-white">CATEGORIES</a>
          <a href="./plants.php?user_id='.$user_id.'" class="list-group-item bg-transparent rounded text-white">PLANTES</a>';
        }
      ?>
      <a href="#" class="list-group-item bg-transparent border-bottom rounded text-white">A fourth item</a>
    </div>
  </section>
  <div class="text-center w-75 p-0 my-4 | container">
    <?php
      if(isset($_GET['user_id'])){
        echo '<h1>Welcome Back '.$user_row['user_FirstName'].'</h1>';
      }
    ?>
  </div>
  <div class="row w-75 gap-4 p-0 mt-5 flex-wrap | container">
    <div class=" ms-lg-5 card text-white mb-3 shadow-lg | info-card" style="max-width: 18rem;">
      <div class="card-body">
        <h2 class="card-title mt-2 fw-bolder">150</h2>
        <p class="card-text mt-4 fs-4">New Orders</p>
      </div>
      <a href="#" class="card-footer text-center text-decoration-none">More Info <span class="ms-2 fa-solid fa-circle-arrow-right" style="color: #ffffff;"> </span></a>
    </div>
    <div class=" card text-white mb-3 shadow-lg | info-card" style="max-width: 18rem;">
      <div class="card-body">
        <?php

          $query = "SELECT * FROM user";
          $result = $conn->query($query);

          $i=0;
          while($rows = $result->fetch_assoc()){
            $i++;
          }
          
          echo '<h2 class="card-title mt-2 fw-bolder">'.$i.'</h2>';
          
        ?>
        <p class="card-text mt-4 fs-4">User Registrations</p>
      </div>
      <a href="#" class="card-footer text-center text-decoration-none">More Info <span class="ms-2 fa-solid fa-circle-arrow-right" style="color: #ffffff;"> </span></a>
    </div>
    <div class=" card text-white mb-3 shadow-lg | info-card" style="max-width: 18rem;">
      <div class="card-body">
      <?php

        $query = "SELECT * FROM plante";
        $result = $conn->query($query);

        $i=0;
        while($rows = $result->fetch_assoc()){
          $i++;
        }

        echo '<h2 class="card-title mt-2 fw-bolder">'.$i.'</h2>';

        ?>
        <p class="card-text mt-4 fs-4">Plants In Stock</p>
      </div>
      <a href="#" class="card-footer text-center text-decoration-none">More Info <span class="ms-2 fa-solid fa-circle-arrow-right" style="color: #ffffff;"> </span></a>
    </div>
  </div>

  

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>

<?php
  die();
?>
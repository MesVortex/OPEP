<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Opep Client Page</title>
  <link rel="stylesheet" href="./css/Commande-style.css">
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
  <header>
    <nav class="navbar | nav-bg">
      <div class="container-fluid">
      <?php
        include "./phpScripts/dbconnect.php";
        
        if(isset($_GET['user_id'])){
          $user_id = $_GET['user_id'];
          echo '<a href="./Client_page.php?user_id='.$user_id.'"><i class="ms-5 fa-solid fa-delete-left fa-xl" style="color: #ffffff;"></i></a>';
        }
      ?>
        <div class="navbar-brand mx-auto | img-box">
          <img src="./images/logo-removebg-preview.png" alt="">
        </div>
      </div>
    </nav>
  </header>

  <h1 class="text-center">FINALISE YOUR ORDER</h1>

  <section class="border rounded border-3 border-success mx-auto my-5 d-flex | commande-section">
    <div class="table-responsive | table-sec">
      <table class="table table-striped">
        <thead><tr> <th scope="col">Plant</th> <th scope="col">Name</th> <th scope="col">Category</th> <th scope="col">Price</th> </tr></thead>
        <tbody>
          <?php

            if(isset($_GET['user_id'])){
              $user_id = $_GET['user_id'];
            }
            $cart_fetch_query = 
            "SELECT plante.*,category.category_name FROM plante 
            JOIN category ON plante.category_id = category.id
            JOIN panier ON panier.userID = $user_id
            JOIN panierxplante ON panierxplante.planteID = plante.plant_id 
            AND
            panierxplante.panierID = panier.id 
            ";
            
            $fetch_result = $conn->query($cart_fetch_query);
          
            
            while($cart_rows = $fetch_result->fetch_assoc()){
              echo '
              <tr?>
                <th scope="row"><img class="card-img-top" src="./images/'.$cart_rows['img_url'].'" alt=""></th>
                <td>'.$cart_rows['name'].'</td>
                <td>'.$cart_rows['category_name'].'</td>
                <td>'.$cart_rows['price'].' MAD</td>
              </tr>';
            }
          ?>
          <form action="./phpScripts/add_commande.php" method="post">
            <tr>
                <th scope="row">Payement method</th>
                <td>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="payementmethod" value="MasterCard" id="flexRadioDefault1" checked>
                    <label class="form-check-label" for="flexRadioDefault1">
                      MasterCard
                    </label>
                  </div>
                </td>
                <td>  
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="payementmethod" value="Paypal" id="flexRadioDefault2">
                    <label class="form-check-label" for="flexRadioDefault2">
                     Paypal
                    </label>
                  </div>
                </td>
                <td>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="payementmethod" value="Visa" id="flexRadioDefault1">
                    <label class="form-check-label" for="flexRadioDefault1">
                      Visa
                    </label>
                  </div>
                </td>
            </tr>
            <tr> <th scope="col">CHECKOUT</th>
              <?php
              if(isset($_GET['user_id'])){
                $user_id = $_GET['user_id'];
                echo '
                <select class="form-select d-none" name="user_id" aria-label="Default select example">
                <option selected>'.$user_id.'</option>
                </select>';
              }
              ?>
              <td colspan="4"><button type="submit" class="btn py-0"><i class="fa-solid fa-circle-check" style="color: #104601;"></i></button></td>
            </tr>
          </form>
        </tbody>
      </table>
    </div>
    <div class="border bg-success border-3 rounded border-success | payer-img-box">
      <!-- <img class="rounded" src="./images/towfiqu-barbhuiya-HNPrWOH2Z8U-unsplash.jpg" alt=""> -->
    </div>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
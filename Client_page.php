<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Opep Client Page</title>
  <link rel="stylesheet" href="./css/Client-style.css">
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
        <div class="navbar-brand | img-box">
          <img src="./images/logo-removebg-preview.png" alt="">
        </div>
        <form class="d-flex" action="./Client_page.php" method="get">
        <?php
        
          if(isset($_GET['user_id'])){
            $user_id = $_GET['user_id'];
            echo '<select class="form-select d-none" name="user_id" aria-label="Default select example">
                      <option selected>'.$user_id.'</option>
                  </select>';
          }
        ?>
          <input class="form-control me-2" id="searchInput" name="search" placeholder="Search plant by name" aria-label="Search">
          <button class="btn btn-outline-light" type="submit">Search</button>
        </form>
        <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
          <span class="fa-solid fa-cart-shopping fa-xl" style="color: #ffffff;"></span>
        </button>
        <div class="offcanvas offcanvas-end | canvas-width" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Shopping Cart</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <div class="table-responsive">
              <table class="table table-striped">
                <thead><tr> <th scope="col">Plant</th> <th scope="col">Name</th> <th scope="col">Category</th> <th scope="col">Price</th> <th scope="col">Remove</th></tr></thead>
                <tbody>
                  <?php
                    include "./phpScripts/dbconnect.php";

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
                      <tr>
                        <th scope="row"><img class="card-img-top" src="./images/'.$cart_rows['img_url'].'" alt=""></th>
                        <td>'.$cart_rows['name'].'</td>
                        <td>'.$cart_rows['category_name'].'</td>
                        <td>'.$cart_rows['price'].' MAD</td>
                        <form action="./phpScripts/delete_from_cart.php" method="post">';
                        if(isset($_GET['user_id'])){
                          $user_id = $_GET['user_id'];
                          echo '<select class="form-select d-none" name="user_id" aria-label="Default select example">
                                    <option selected>'.$user_id.'</option>
                                </select>';
                        }
                          echo' <select class="form-select d-none" name="plant_id" aria-label="Default select example">
                          <option selected>'.$cart_rows['plant_id'].'</option>
                          </select>
                          <td><button type="submit" class="btn"><i class="fa-solid fa-circle-minus text-danger"></i></button></td>
                        </form>
                      </tr>';
                    }
                  ?>
                  <tr> <th scope="col">Purchase</th>
                    <?php
                     if(isset($_GET['user_id'])){
                       $user_id = $_GET['user_id'];
                       echo '<form action="./commande.php?user_id='.$user_id.'" method="post">
                       <select class="form-select d-none" name="user_id" aria-label="Default select example">
                       <option selected>'.$user_id.'</option>
                       </select>';
                     }
                    ?>
                    <td colspan="4"><button type="submit" class="btn py-0"><i class="fa-solid fa-circle-check" style="color: #104601;"></i></button></td>
                  </form>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </nav>
  </header>
  <div class="">
    <h1 class="text-center my-5">OUR PRODUCTS</h1>
  </div>
  <form class="filter-section | mt-4 ms-3" action="./Client_page.php" method="GET">
    <div class="d-flex justify-content-center align-items-center rounded-pill hover| filter-header">
      <button type="submit" class="mb-0 fs-5 btn fw-bold text-white">Filter</button>
    </div>
    <div class="ms-5 mb-3 | filter-body">
      <?php

        $query = "SELECT * FROM category";
        $result = $conn->query($query);

        if(isset($_GET['user_id'])){
          $user_id = $_GET['user_id'];
          echo '<select class="form-select d-none" name="user_id" aria-label="Default select example">
                    <option selected>'.$user_id.'</option>
                </select>';
        }
        while($rows = $result->fetch_assoc()){
          $checkedCategories = [];
          if(isset($_GET['categoryList'])){
            $checkedCategories = $_GET['categoryList'];
          }
          echo      '<div class="form-check form-switch mb-2">
          <input class="form-check-input filterSwitch" name="categoryList[]" value ="'.$rows['id'].'" type="checkbox" role="switch"';
          if(in_array($rows['id'], $checkedCategories)){
            echo 'checked';
          }
          echo '>
          <label class="form-check-label" for="filterSwitch">'.$rows['category_name'].'</label>
        </div>';
        }
        
      ?>
    </div>
  </form>
  <section class="product-section mb-5 | d-inline-flex justify-content-evenly flex-wrap gap-5" id="product_section">
    <?php

      // if(isset($_GET['categoryList'])){

      //   $checked = [];
      //   $checked = $_GET['categoryList'];
      //   foreach($checked as $categoryID){

          // $filter_query = 
          // "SELECT plante.*,category.category_name 
          // FROM plante 
          // JOIN category 
          // ON plante.category_id = category.id 
          // AND
          // plante.category_id = ($categoryID)";

          // $result = $conn->query($filter_query);

          // while($rows = $result->fetch_assoc()){
          //   echo '<div class="card border-success shadow-lg" style="width: 18rem;">
          //   <img src="./images/'.$rows['img_url'].'" class="card-img-top" alt="...">
          //   <div class="card-body">
          //     <ul class="list-group list-group-flush">
          //       <li class="list-group-item border-success"><span class="fw-bold">Name: </span>'.$rows['name'].'</li>
          //       <li class="list-group-item border-success"><span class="fw-bold">Category: </span>'.$rows['category_name'].'</li>
          //       <li class="list-group-item border-success"><span class="fw-bold">Price: </span>'.$rows['price'].' MAD</li>
          //     </ul>
          //     <form action="./phpScripts/add_to_cart.php" method="post">
          //     <select class="form-select d-none" name="plant_id" aria-label="Default select example">
          //       <option selected>'.$rows['plant_id'].'</option>
          //     </select>';
          //     if(isset($_GET['user_id'])){
          //       $user_id = $_GET['user_id'];
          //       echo '<select class="form-select d-none" name="user_id" aria-label="Default select example">
          //                 <option selected>'.$user_id.'</option>
          //             </select>';
          //     }
          //     echo '<button type="submit" class="btn text-white mt-2 | add-btn">ADD To Cart</button>
          //   </form>
          //   </div>
          // </div>';
          // }
        // }

      // }else if(isset($_GET['search'])){

      //   $searchValue = $_GET['search'];

      //   $search_query = 
      //   "SELECT plante.*,category.category_name
      //   FROM plante
      //   JOIN category
      //   ON plante.category_id = category.id
      //   AND
      //   plante.name = '$searchValue'";

      //   $search_result = $conn->query($search_query);
      //   $i = 0;
          
      //   while($rows = $search_result->fetch_assoc()){
      //     $i++;
      //     echo '<div class="card border-success shadow-lg" style="width: 18rem;">
      //     <img src="./images/'.$rows['img_url'].'" class="card-img-top" alt="...">
      //     <div class="card-body">
      //       <p class="card-text"></p>
      //       <ul class="list-group list-group-flush">
      //         <li class="list-group-item border-success"><span class="fw-bold">Name: </span>'.$rows['name'].'</li>
      //         <li class="list-group-item border-success"><span class="fw-bold">Category: </span>'.$rows['category_name'].'</li>
      //         <li class="list-group-item border-success"><span class="fw-bold">Price: </span>'.$rows['price'].' MAD</li>
      //       </ul>
      //       <form action="./phpScripts/add_to_cart.php" method="post">
      //         <select class="form-select d-none" name="plant_id" aria-label="Default select example">
      //           <option selected>'.$rows['plant_id'].'</option>
      //         </select>';
      //         if(isset($_GET['user_id'])){
      //           $user_id = $_GET['user_id'];
      //           echo '<select class="form-select d-none" name="user_id" aria-label="Default select example">
      //                     <option selected>'.$user_id.'</option>
      //                 </select>';
      //         }
      //         echo '<button type="submit" class="btn text-white mt-2 | add-btn">ADD To Cart</button>
      //       </form>
      //     </div>
      //     </div>';  
      //   }
        
      //   if($i === 0){
      //       echo'<div class="alert alert-danger" role="alert">
      //       NO RESULTS FOUND!
      //     </div>';
      //   }

      // }else{

        $show_all_query = 
        "SELECT plante.*,category.category_name
        FROM plante
        JOIN category
        ON plante.category_id = category.id";

        $result = $conn->query($show_all_query);

        while($rows = $result->fetch_assoc()){
          echo '<div class="card border-success shadow-lg" style="width: 18rem;">
          <img src="./images/'.$rows['img_url'].'" class="card-img-top" alt="...">
          <div class="card-body">
            <p class="card-text"></p>
            <ul class="list-group list-group-flush">
              <li class="list-group-item border-success"><span class="fw-bold">Name: </span>'.$rows['name'].'</li>
              <li class="list-group-item border-success"><span class="fw-bold">Category: </span>'.$rows['category_name'].'</li>
              <li class="list-group-item border-success"><span class="fw-bold">Price: </span>'.$rows['price'].' MAD</li>
            </ul>
            <form action="./phpScripts/add_to_cart.php" method="post">
              <select class="form-select d-none" name="plant_id" aria-label="Default select example">
                <option selected>'.$rows['plant_id'].'</option>
              </select>';
              if(isset($_GET['user_id'])){
                $user_id = $_GET['user_id'];
                echo '<select class="form-select d-none" name="user_id" aria-label="Default select example">
                          <option selected>'.$user_id.'</option>
                      </select>';
              }
              echo '<button type="submit" class="btn text-white mt-2 | add-btn">ADD To Cart</button>
            </form>
          </div>
          </div>';
        }
      // }
    ?>
  </section>

  <script src="./js/ajax.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
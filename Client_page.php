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
                <thead><tr> <th scope="col">Plant</th> <th scope="col">Name</th> <th scope="col">Category</th> <th scope="col">Price</th> <th scope="col">Validate</th> <th scope="col">Remove</th></tr></thead>
                <tbody>
                  <?php
                    include "./phpScripts/dbconnect.php";


                    echo '
                    <tr>
                      <th scope="row"><img class="card-img-top" src="./images/IMG-65647564d19fe7.33276743.jpg" alt=""></th>
                      <td>name</td>
                      <td>category</td>
                      <td>price MAD</td>
                      <form action="" method="post">
                        <td><button type="submit" class="btn"><i class="fa-solid fa-circle-check" style="color: #104601;"></i></button></td>
                      </form>
                      <form action="" method="post">
                        <td><button type="submit" class="btn"><i class="fa-solid fa-circle-minus text-danger"></i></button></td>
                      </form>
                    </tr>';
                    if(isset($_GET['user_id'])){
                        $user_id = $_GET['user_id'];
                        echo '<select class="form-select d-none" name="user_id" aria-label="Default select example">
                                  <option selected>'.$user_id.'</option>
                              </select>';
                      }
                    echo '';
                  ?>
                </tbody>
              </table>
            </div>
            <!-- <div class="card border-success" style="width: 20rem;">
              <img src="./images/IMG-656515181fcc95.19420281.jpg" class="card-img-top" alt="...">
              <div class="card-body">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item border-success"><span class="fw-bold">Name: </span>placholder</li>
                  <li class="list-group-item border-success"><span class="fw-bold">Category: </span>placholder</li>
                  <li class="list-group-item border-success"><span class="fw-bold">Price: </span>placholder MAD</li>
                </ul>
                <div>
                  <button type="submit" class="btn btn-danger">Remove From Cart</button>
                </div>
              </div>
            </div> -->
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
          <input class="form-check-input" name="categoryList[]" value ="'.$rows['id'].'" type="checkbox" role="switch" id="filterSwitch"';
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
  <section class="product-section mb-5 | d-inline-flex justify-content-evenly flex-wrap gap-5">
    <?php

      if(isset($_GET['categoryList'])){

        $checked = [];
        $checked = $_GET['categoryList'];
        foreach($checked as $categoryID){

          $filter_query = 
          "SELECT plante.*,category.category_name 
          FROM plante 
          JOIN category 
          ON plante.category_id = category.id 
          AND
          plante.category_id = ($categoryID)";

          $result = $conn->query($filter_query);

          while($rows = $result->fetch_assoc()){
            echo '<div class="card border-success shadow-lg" style="width: 18rem;">
            <img src="./images/'.$rows['img_url'].'" class="card-img-top" alt="...">
            <div class="card-body">
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
        }

      }else{

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
      }
    ?>
  </section>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
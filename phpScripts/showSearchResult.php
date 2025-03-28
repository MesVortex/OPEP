<?php

if(isset($_GET['search'])){

  include "./dbconnect.php";

  $searchValue = $_GET['search'];

  $search_query = 
  "SELECT plante.*,category.category_name
  FROM plante
  JOIN category
  ON plante.category_id = category.id
  AND
  plante.name = '$searchValue'";

  $search_result = $conn->query($search_query);
  $i = 0;
    
  while($rows = $search_result->fetch_assoc()){
    $i++;
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
  
  if($i === 0){
      echo'<div class="alert alert-danger" role="alert">
      NO RESULTS FOUND!
    </div>';
  }

}

if(isset($_GET['filter'])){

  $categoryID = $_GET['filter'];

  $filter_query = 
  "SELECT plante.*,category.category_name 
  FROM plante 
  JOIN category 
  ON plante.category_id = category.id 
  AND
  plante.category_id = ($categoryID)";

  $result = $conn->query($filter_query);
  $i = 0;

  while($rows = $result->fetch_assoc()){
    $i++;
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

  if($i === 0){
    echo'<div class="alert alert-danger mx-auto" role="alert">
    NO PLANTS IN THIS CATEGORY!
  </div>';
  }


}
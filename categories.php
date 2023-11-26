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
      <?php
        if(isset($_GET['user_id'])){
          $user_id = $_GET['user_id'];
          echo '<a href="./Admin_page.php?user_id='.$user_id.'" class="list-group-item bg-transparent rounded text-white">DASHBOARD</a>';
        }
      ?>
      <a href="#" class="list-group-item bg-transparent rounded text-white">CATEGORIES <span class="ms-2 fa-solid fa-caret-right" style="color: #ffffff;"> </span></a>
      <?php
        if(isset($_GET['user_id'])){
          $user_id = $_GET['user_id'];
          echo '<a href="./plants.php?user_id='.$user_id.'" class="list-group-item bg-transparent rounded text-white">PLANTES</a>';
        }
      ?>
      <a href="#" class="list-group-item bg-transparent border-bottom rounded text-white">A fourth item</a>
    </div>
  </section>
  <div class="text-center w-75 p-0 my-4 | container">
    <h1>CATEGORIES</h1>
  </div>
  <div class="text-center w-75 p-0 my-5 | container">
    <table class="ms-4 table">
      <thead><tr><th scope="col">ID</th> <th scope="col">Name</th> <th scope="col">Modify</th></tr></thead>
      <tbody>
      <?php
        $category_query = "SELECT * FROM category";
        $category_result = $conn->query($category_query);

        while($category_rows = $category_result->fetch_assoc()){
          echo '
            <tr>
              <th scope="row">'.$category_rows['id'].'</th>
              <td>'.$category_rows['category_name'].'</td>
              <td><a type="button" data-bs-toggle="modal" data-bs-target="#modifyCategoryModal'.$category_rows['id'].'"><i class="fa-solid fa-bars-progress" style="color: #104601;"></i></a></td>
            </tr>
            <!--Modify Category Modal -->
            <div class="modal fade" id="modifyCategoryModal'.$category_rows['id'].'" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="staticBackdropLabel">Modify '.$category_rows['category_name'].' Category</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form action="./phpScripts/modify_category.php" method="post" class="d-flex justify-content-evenly">
                    <div>
                      <label for="newName" class="text-start form-label">New Name</label>
                      <input type="text" name="newName" class="form-control" id="newName" placeholder="exp: orchids">
                      <select class="form-select d-none" name="category_id" aria-label="Default select example">
                          <option selected>'.$category_rows['id'].'</option>
                      </select>';
                      if(isset($_GET['user_id'])){
                        $user_id = $_GET['user_id'];
                        echo '<select class="form-select d-none" name="user_id" aria-label="Default select example">
                                  <option selected>'.$user_id.'</option>
                              </select>';
                      }    
                    echo '</div>
                    <div class="align-self-end">
                      <button type="submit" class="btn btn-success">Done</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>';
        }
      ?>
        <tr>
          <th scope="row">ADD</th>
          <td colspan="2"><a type="button" data-bs-toggle="modal" data-bs-target="#addCategoryModal"><i class="fa-solid fa-circle-plus" style="color: #014601;"></i></a></td>
        </tr>
      </tbody>
    </table>
    <!--ADD Category Modal -->
    <div class="modal fade" id="addCategoryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Category</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="./phpScripts/add_category.php" method="post" class="d-flex justify-content-evenly">
              <div>
                <label for="newCategoryName" class="text-start form-label">New Category Name</label>
                <input type="text" name="categoryName" class="form-control" id="newCategoryName" placeholder="exp: orchids">
                <?php
                  if(isset($_GET['user_id'])){
                    $user_id = $_GET['user_id'];
                    echo '<select class="form-select d-none" name="user_id" aria-label="Default select example">
                              <option selected>'.$user_id.'</option>
                          </select>';
                  }
                ?>
              </div>
              <div class="align-self-end">
                <button type="submit" class="btn btn-success">Done</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign_up</title>
  <link rel="stylesheet" href="./css/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>
<body>
  <header class="navbar bg-body-tertiary shadow border-bottom">
    <div class="mx-auto | logo-box">
      <a class="navbar-brand" href="#">
        <img src="./images/logo-removebg-preview.png" class="logo" alt="">
      </a>
    </div>
  </header>
  <section class="row align-items-center | login-sec">
    <div class="col d-none d-lg-block">
      <img src="./images/SignUp_page_image.png" alt="">
    </div>
    <div class="col pe-lg-5">
      <div class="container mx-auto">
        <h2 class="display-3 fw-bold my-lg-5 mb-5 text-center">SIGN UP</h2>
      </div>
      <div class="form-container">
        <form action="./phpScripts/signup_data_check.php" method="post" id="form" class="d-flex-column">
          <input 
          type="text"
          name="firstName"
          id="First_Name"
          class="form-control border-success border-3 col mx-auto"
          placeholder="First Name" 
          aria-describedby="FirstNameInputHelp">
          <div id="FirstNameInputHelp" class="form-text text-danger | error_para">
            Your name must be less than 20 characters and musn't include any numbers or special characters.
          </div>
          <input 
          type="text" 
          name="lastName"
          id="Last_Name" 
          class="form-control border-success border-3 col mt-4 mx-auto"
          placeholder="Last Name" 
          aria-describedby="LastNameInputHelp">
          <div id="LastNameInputHelp" class="form-text text-danger | error_para">
            Your name must be less than 20 characters and musn't include any numbers or special characters.
          </div>
          <input 
          type="email" 
          id="Email"
          name="email" 
          class="form-control border-success border-3 col mt-4 mx-auto"
          placeholder="Email" 
          aria-describedby="EmailInputHelp">
          <div id="EmailInputHelp" class="form-text text-danger | error_para">
            Your name must be less than 20 characters and musn't include any numbers or special characters.
          </div>
          <input 
          type="password"
          id="password"
          name="pwd"
          class="form-control border-success border-3 col mt-4 mx-auto"
          placeholder="Password"
          aria-describedby="PasswordInputHelp">
          <?php
          if(isset($_GET['error']) && $_GET['error'] == 'accountexist'){
            echo '<div id="PasswordInputHelp" class="form-text text-danger text-center fw-bold mt-4">
            This Account Already Exists.
          </div>';
          }
          if(isset($_GET['error']) && $_GET['error'] == 'empty'){
            echo '<div id="PasswordInputHelp" class="form-text text-danger text-center fw-bold mt-4">
            Please Fill The Form Above First.
          </div>';
          }
          ?>
          <button id="next_btn" type="submit" class="btn btn-success px-5 py-2 mt-4 d-block mx-auto | next-btn">
            Next
          </button>
          <div class="progress my-4 w-75 mx-auto" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
            <div class="progress-bar bg-success" style="width: 50%">1/2</div>
          </div>
        </form>
      </div>
    </div>
  </section>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
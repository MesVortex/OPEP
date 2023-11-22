<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
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
  <section class="row | login-sec">
    <div class="col d-none d-lg-block">
      <img src="./images/Login_page_image.png" alt="">
    </div>
    <div class="col pe-lg-5">
      <div class="container mx-auto">
        <h2 class="display-3 fw-bold my-lg-5 mb-5 text-center">LOGIN</h2>
      </div>
      <div class="form-container">
        <form action="#" id="form" class="d-flex-column">
              <input 
              type="text" 
              id="email" 
              class="form-control border-success border-3 col mx-auto"
              placeholder="Email" 
              aria-describedby="FirstNameInputHelp">
              <div id="FirstNameInputHelp" class="form-text text-danger | error_para">
                Your name must be less than 20 characters and musn't include any numbers or special characters.
              </div>
              <input 
              type="password"
              id="password" 
              class="form-control border-success border-3 col mt-4 mx-auto"
              placeholder="Password"
              aria-describedby="LastNameInputHelp">
              <div id="LastNameInputHelp" class="form-text text-danger | error_para">
                Your name must not exceed 20 characters and not include any numbers or special characters.
              </div>
          <button type="submit" class="btn btn-success px-5 py-2 mt-4 d-block mx-auto | submit-btn">
            Log In
          </button>
          <div class="d-flex justify-content-center mt-4">
            <p class="fw-bold me-2">New to OPEP?</p>
            <a href="sign_up.php" class="text-success fw-bold">Sign Up.</a>
          </div>
        </form>
      </div>
    </div>
  </section>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
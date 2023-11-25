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
    <div class="col pe-lg-5 d-flex-column">
      <div class="container mx-auto">
        <h2 class="display-3 fw-bold my-lg-5 mb-5 text-center">Choose Your Role</h2>
      </div>
      <form method="post" action="./phpScripts/signup_role_check.php">
        <select name="userRole" class="form-select border-3 border-success w-50 mx-auto" aria-label="select role">
            <option selected>Client</option>
            <option value="Administrator">Administrator</option>
        </select>
        <button id="submit_btn" type="submit" value="Submit" class="btn btn-success px-5 py-2 mt-4 d-block mx-auto | submit-role-btn">
          Finish
        </button>
      </form>
      <div class="progress my-5 w-75 mx-auto" role="progressbar" aria-label="Success example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">
        <div class="progress-bar bg-success" style="width: 100%">2/2</div>
      </div>
    </div>
  </section>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
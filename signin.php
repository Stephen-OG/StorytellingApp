<?php
      include("connection.php");
      include("functions.php");

      
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Give me a title</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- Google fonts - Popppins for copy-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,800">
    <!-- orion icons-->
    <link rel="stylesheet" href="css/orionicons.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/favicon.png?3">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <br>
    <br>
    <h1 style="padding-left: 5%; color: skyblue;" class="mb-4">StoryTelling App</h1>
                      
    <div class="page-holder d-flex align-items-center">
      <div class="container">
        <div class="row align-items-center py-5">
          <div class="col-5 col-lg-7 mx-auto mb-5 mb-lg-0">
            <div class="pr-lg-5"><img src="img/wiys.jpg" alt="" class="img-fluid"></div>
          </div>
          <div class="col-lg-5 px-lg-4">
            <h1 class="text-base text-primary text-uppercase mb-4">Sign In</h1>
            <h2 class="mb-4">Welcome back!</h2>
            <p class="text-muted">Everyone has a story!</p>
            <form id="loginForm" class="mt-4" method="POST">
              <div class="form-group mb-4">
                <input type="text" name="email" id="email" placeholder="Email address" class="form-control border-0 shadow form-control-lg">
              </div>
              <div class="form-group mb-4">
                <input type="password" name="password" id="password" placeholder="Password" class="form-control border-0 shadow form-control-lg text-violet">
              </div>
              <div class="form-group mb-4">
                <div class="custom-control custom-checkbox">
                  <input id="customCheck1" type="checkbox" name="remember" value="1" checked class="custom-control-input">
                  <label for="customCheck1" class="custom-control-label">Remember Me</label>
                </div>
              </div>
              <button name="loginbtn" type="submit" class="btn btn-primary shadow px-5">Sign in</button>
              <br>
              <br>
              <small>Don't have an account? <a href="signup.php">Sign up</a></small>
            </form>
            <?php
              if(isset($_COOKIE['email']) and isset($_COOKIE['password'])){
                $email = $_COOKIE['email'];
                $pass = $_COOKIE['password'];
                echo "<script>
                  document.getElementById('email').value = '$email';
                  document.getElementById('password').value = '$pass';
            
                </script>";
              }
            ?>
          </div>
        </div>
        
        <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)                 -->
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="vendor/sweetalert/sweetalert.min.js"></script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/popper.js/umd/popper.min.js"> </script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="vendor/chart.js/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
    <script src="js/front.js"></script>
    <?php include("footer.php")?>
  </body>
</html>
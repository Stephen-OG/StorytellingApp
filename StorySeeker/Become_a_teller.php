<?php
    include("../connection.php");
      include("../functions.php");
      include("../ss_functions.php");

      $become_a_story_teller = become_a_story_teller($con);
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
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <!-- Google fonts - Popppins for copy-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,800">
    <!-- orion icons-->
    <link rel="stylesheet" href="../css/orionicons.css">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="../css/style.default.css" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="../css/custom.css">
    <!-- Favicon-->
    <link rel="shortcut icon" href="../img/favicon.png?3">
    <!-- jQuery -->
    <script src="../js/jquery-3.5.1.min.js"></script>
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
          
          <div class="col-lg-5 px-lg-4">
            <h1 class="text-base text-primary text-uppercase mb-4">Become a Story Teller</h1>
            <h2 class="mb-4">Welcome!</h2>
            <p class="text-muted">Are you sure you want to Become a story teller?</p>
            <form id="BeATeller" class="mt-4" method="post">
              <div class="custom-control custom-checkbox">
                <input id="customCheck1" type="checkbox" checked class="custom-control-input">
                <input type="hidden" name="isStoryTeller" value="1" class="form-control">
                <!-- <label for="customCheck1" class="custom-control-label">Remember Me</label> -->
              </div>
              <button name="btnStoryTeller" type="submit" class="btn btn-primary shadow px-5">Yes</button>

              <br>
              <br>
              <small>Not interested? <a href="index.php">go back to seeker page</a></small>
            </form>
          </div>
        </div>
        
        <!-- Please do not remove the backlink to us unless you support further theme's development at https://bootstrapious.com/donate. It is part of the license conditions. Thank you for understanding :)                 -->
      </div>
    </div>
    <!-- JavaScript files-->
    <script src="../vendor/sweetalert/sweetalert.min.js"></script>
    <!-- <script src="../custom/custom.js"></script> -->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/popper.js/umd/popper.min.js"> </script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="../vendor/chart.js/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
    <script src="../js/front.js"></script>
    <?php include("../footer.php")?>

  </body>
</html>
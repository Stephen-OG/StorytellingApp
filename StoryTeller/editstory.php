<?php
      include("../connection.php");
      include("../functions.php");
      include("../st_functions.php");


      $check_login = user_login_check($con);
      //$update_profile = updateProfile($con);
      //$change_password = change_password($con);
      $populate_story = get_story_by_id($con);
      //$edit_story = edit_story($con);

?>

<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="../custom/custom.css">

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Edit Story | Story Teller</title>
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
  <script src="../js/jquery-3.5.1.min.js"></script>
  <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->

</head>

<body>
  <!-- navbar-->
  <header class="header">
    <nav class="navbar navbar-expand-lg px-4 py-2 bg-white shadow"><a href="#"
        class="sidebar-toggler text-gray-500 mr-4 mr-lg-5 lead"><i class="fas fa-align-left"></i></a><a
        href="index.php" class="navbar-brand font-weight-bold text-uppercase text-base">Story Telling App</a>
      <ul class="ml-auto d-flex align-items-center list-unstyled mb-0">


      <li class="nav-item dropdown ml-auto"><a id="userInfo" href="http://example.com" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><img id="profileImage" src="" style="max-width: 2.5rem;" class="img-fluid rounded-circle shadow"></a>
            <div aria-labelledby="userInfo" class="dropdown-menu"><a href="#" class="dropdown-item"><strong class="d-block text-uppercase headings-font-family"><?php echo $check_login['FirstName'];?>  <?php echo $check_login['LastName'];?></strong><small>Story Teller</small></a>
              <div class="dropdown-divider"></div><a data-toggle="modal" data-target="#editProfileModal" class="dropdown-item">Edit Profile</a><a data-toggle="modal" data-target="#changePasswordModal" class="dropdown-item">Change Password</a>
              <a data-toggle="modal" data-target="#deleteAccountModal" class="dropdown-item">Delete Account</a>
              <div class="dropdown-divider"></div>
              <a href="logout.php" class="dropdown-item">Logout</a>
            </div>
          </li>
      </ul>
    </nav>
  </header>
  <div class="d-flex align-items-stretch">
    <div id="sidebar" class="sidebar py-3">
      <div class="text-gray-400 text-uppercase px-3 px-lg-4 py-4 font-weight-bold small headings-font-family">MAIN</div>
      <ul class="sidebar-menu list-unstyled">
        <li class="sidebar-list-item"><a href="index.php" class="sidebar-link text-muted"><i class="o-home-1 mr-3 text-gray"></i><span>Home</span></a></li>
              <li class="sidebar-list-item"><a href="addstory.php" class="sidebar-link text-muted"><i class="o-paper-stack-1 mr-3 text-gray"></i><span>Add Story</span></a></li>
              <li class="sidebar-list-item"><a href="stories.php" class="sidebar-link text-muted active"><i class="o-archive-folder-1 mr-3 text-gray"></i><span>My Stories</span></a></li>
              <li class="sidebar-list-item"><a href="../StorySeeker/index.php" class="sidebar-link text-muted"><i class="o-search-magnify-1 mr-3 text-gray"></i><span>Seek Stories</span></a></li>           
      </ul>
      <div class="text-gray-400 text-uppercase px-3 px-lg-4 py-4 font-weight-bold small headings-font-family">EXTRAS
      </div>
      <ul class="sidebar-menu list-unstyled">
        <li class="sidebar-list-item"><a href="#" class="sidebar-link text-muted"><i
              class="o-database-1 mr-3 text-gray"></i><span>Ratings and Reviews</span></a></li>
      </ul>
  
    </div>
    
    <div class="page-holder w-100 d-flex flex-wrap">
      <div class="container-fluid px-xl-5">
        <section class="py-5">
          <div class="row">


            <!-- Form Elements -->
            <div class="col-lg-12 mb-5">
              <div class="card">
                <div class="card-header">
                  <h3 class="h6 text-uppercase mb-0">Edit Story</h3>
                </div>
                <div class="card-body">
                  <form action="../st_functions.php" class="form-horizontal" id="editStoryForm" method="POST" enctype="multipart/form-data">

                    <div class="form-group row">
                      <label class="col-md-3 form-control-label">Title</label>
                      <div class="col-md-9">
                        <input type="text" id="storytitle" name="title" value="<?php echo $populate_story['Title'];?>"  class="form-control" required>
                      </div>
                    </div>
                    <div class="line"></div>
                    
                    <div class="line"></div>
                    <div class="form-group row"> 
                      <label class="col-md-3 form-control-label">Location Image</label>
                      <div class="col-md-9">
                      <input type="hidden" id="imagename" name="imagename" value="<?php echo $populate_story['ImageName'];?>"  class="form-control" required>

                      <input type="file" id="fileSelect" name="photo" class="form-control">
                      </div>
                    </div>
                    <div class="line"></div>
                    <div class="line"></div>


                    <div class="form-group row">
                      <label class="col-md-3 form-control-label">Body</label>
                      <div class="col-md-9">
                        <textarea type="text" id="storybody" name="body" rows="8" cols="50" class="form-control"
                          required><?php echo $populate_story['Body'];?>"</textarea>
                      </div>
                    </div>
                    <div class="line"></div>

                    <div class="form-group row">
                      <div class="col-md-9 ml-auto">
                        <!-- <button type="submit" class="btn btn-secondary">Cancel</button> -->
                        <button type="submit" name="editStory" id="btnedit" class="btn btn-primary">Save changes</button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>


            <!--Edit Profile Modal-->
            <div id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel"
              aria-hidden="true" class="modal fade text-left">
              <div role="document" class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 id="editProfileModalLabel" style="color: #004ef9;"
                      class="modal-title navbar-brand font-weight-bold text-uppercase text-base">Edit Profile</h4>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                        aria-hidden="true">??</span></button>
                  </div>
                  <div class="modal-body">
                    <!-- GET CONTENT FOR LOREM -->
                    <p>Lorem ipsum dolor sit amet consectetur.</p>
                    <form action="../functions.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="img">Profile Picture</label>
                            <input type="hidden" id="imagename" name="imagename" value="<?php echo $check_login['ProfileImage'];?>"  class="form-control" required>

                            <input type="file" id="fileSelect" name="photo" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Firstname</label>
                            <input type="text" name="firstname" value="<?php echo $check_login['FirstName'];?>" id="firstname" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Lastname</label>
                            <input type="text" name="lastname" value="<?php echo $check_login['LastName'];?>" id="lastname" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="updateProfile" id="btneditprofile" value="update" class="btn btn-primary">
                        </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>

                  </div>
                </div>
              </div>
            </div>

            <!-- Change Password Modal-->
            <div id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel"
              aria-hidden="true" class="modal fade text-left">
              <div role="document" class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h4 id="changePasswordModalLabel" style="color: #004ef9;"
                      class="modal-title navbar-brand font-weight-bold text-uppercase text-base">Change Password</h4>

                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                        aria-hidden="true">??</span></button>
                  </div>
                  <div class="modal-body">
                    <!-- GET CONTENT FOR LOREM -->
                    <p>Lorem ipsum dolor sit amet consectetur.</p>
                    <form action="../functions.php" method="POST">
                        <div class="form-group">
                            <label>Old Password</label>
                            <input type="password" name="currentpassword" placeholder="Old Password" id="oldpassword" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" name="password" placeholder="New Password" id="newpassword" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Confirm New Password</label>
                            <input type="password" name="confirmpassword" placeholder="Confirm New Password" id="confirnnewpassword" class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="changePassword" id="btnchangepassword" value="Save Changes" class="btn btn-primary">
                        </div>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                  </div>
                </div>
              </div>
            </div>
            <!-- Delete Account Modal-->
          <div id="deleteAccountModal" tabindex="-1" role="dialog" aria-labelledby="deleteAccountModalLabel" aria-hidden="true" class="modal fade text-left">
            <div role="document" class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 id="deleteAccount" style="color: #004ef9;" class="modal-title navbar-brand font-weight-bold text-uppercase text-base">Delete Account</h4>
                  <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">??</span></button>
                </div>
                <div class="modal-body">
                  <p>Are you sure you want to delete your account?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" id="btndeletestory" data-dismiss="modal" class="btn btn-primary">Yes</button>
                  <button type="button" data-dismiss="modal" class="btn btn-secondary">No</button>
                </div>
              </div>
            </div>
          </div>
          </div>
        </section>
      </div>
      <footer class="footer bg-white shadow align-self-end py-3 px-xl-5 w-100">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-6 text-center text-md-left text-primary">
              <p class="mb-2 mb-md-0">Story Telling App &copy; 2022</p>
            </div>
            <div class="col-md-6 text-center text-md-right text-gray-400">


            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <!-- JavaScript files-->
  <script src="../vendor/sweetalert/sweetalert.min.js"></script>
  <script src="../address.js"></script>
  <script src="../custom/custom.js"></script>
  <!-- <script>
    document.getElementById("editStoryForm").addEventListener("submit", function (e) {
      e.preventDefault();

      let longitude = chosenLocation.lon;
      let latitude = chosenLocation.lat;

      let location = chosenLocation.city + ", " + chosenLocation.county;
      //let category = document.getElementById("categoryChosen").value;
      // let url = "{% url 'search' 3 99999999999 99999999991 22222222222 %}"
      // url = url.replace("3", category)
      // url = url.replace("99999999999", longitude)
      // url = url.replace("99999999991", latitude)
      // url = url.replace("22222222222", location)
      // document.location.href = url

      var data = {
        title: $('#storytitle').val(""),
        storyLocation: location,
        locationImage: $('#img').val(""),
        storyType: $('#storytype').val(""),
        body: $('#storybody').val(""),

      }


      console.log(data);
      if (data.title != "" || data.storyLocation != "" || data.locationImage != "" || data.storyType != "" || data.body != "") {
        editStory();

      }
      else {

        swal("Not yet", "All fields are required!", "warning");

      }
    });

  </script> -->
  <script src="../vendor/sweetalert/sweetalert.min.js"></script>
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/popper.js/umd/popper.min.js"> </script>
  <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
  <script src="../vendor/jquery.cookie/jquery.cookie.js"> </script>
  <script src="../vendor/chart.js/Chart.min.js"></script>
  <script src="../https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
  <script src="../js/front.js"></script>
  <script type='text/javascript'>
      //use alternative image if Profile Image not found
      document.getElementById('profileImage').src="../uploads/<?php echo $check_login['ProfileImage'];?>";

      document.getElementById('profileImage').onload = function() { 
      }

      document.getElementById('profileImage').onerror = function() { 
        document.getElementById('profileImage').src="../img/avatar-6.jpg"; 
      }
</script>
<?php include("../footer.php")?>

</body>

</html>
<?php
      include("../connection.php");
      include("../functions.php");
      include("../st_functions.php");

      $check_login = user_login_check($con);

      $my_stories = my_stories($con);
?>    

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="../custom/custom.css">

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>My Stories | Story Teller</title>
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
        <!--Fontawesome-->
        <link rel="stylesheet" href="../vendor/font-awesome/css/font-awesome.css">
        <!--Search table-->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>  
        <script src="https://kit.fontawesome.com/5da43224bf.js" crossorigin="anonymous"></script>
        <!-- Tweaks for older IEs--><!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
      </head>
  <body>
    <!-- navbar-->
    <header class="header">
      <nav class="navbar navbar-expand-lg px-4 py-2 bg-white shadow"><a href="#" class="sidebar-toggler text-gray-500 mr-4 mr-lg-5 lead" ><i class="fas fa-align-left"></i></a><a href="index.php" class="navbar-brand font-weight-bold text-uppercase text-base">Story Telling App</a>
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
        <!-- <div class="text-gray-400 text-uppercase px-3 px-lg-4 py-4 font-weight-bold small headings-font-family">EXTRAS</div>
        <ul class="sidebar-menu list-unstyled">
              <li class="sidebar-list-item"><a href="#" class="sidebar-link text-muted"><i class="o-database-1 mr-3 text-gray"></i><span>Ratings and Reviews</span></a></li>
        </ul> -->
      </div>
      <div class="page-holder w-100 d-flex flex-wrap">
        <div class="container-fluid px-xl-5">
          <section class="py-5">
            <div class="row">
              <!-- TABLE SHOWING ALL MARK STEPHEN STORIES -->
              <div class="searchTable">
                Search: <input type="text" id="search" class="search">
              </div>
              <div id = "StoriesTable" >
                <table id = "myStoriesTable" class="table-sortable"> 
                <thead>
                  <tr>
                    <th hidden></th>
                    <th>S/N</th>
                    <th style="width: 30%;" >TITLE</th>
                    <th style="width: 20%;" >CATEGORY</th>
                    <th style="width: 30%;">LOCATION</th>
                    <th style="width: 20%;"></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                
                  <?php 
                  $i=1;
                  while($row = mysqli_fetch_array($my_stories) )
                {
                ?>
                  <tr>
                    <td hidden><?php echo $row["id"]; ?></td>
                    <td><?php echo $i?></td>
                    <td><?php echo $row["Title"]; ?></td>
                    <td><?php echo $row["Category"]; ?></td>
                    <td><?php echo $row["Location"]; ?></td>
                    <td><?php if($row["StoryStatus"] == 'Approved')
                              {
                                  echo "<div class='icon text-white bg-green'><i
                                          class='fas fa-check-circle'></i></div>";
                              }elseif($row["StoryStatus"] == 'Pending')
                              {
                                  echo "<div class='icon text-white bg-orange'><i
                                          class='fas fa-check-circle'></i></div>";
                              }elseif($row["StoryStatus"] == 'Rejected')
                              {
                                  echo "<div class='icon text-white bg-red'><i
                                          class='fas fa-check-circle'></i></div>";
                              };                                    
                                            
                        ?></td>
                    <td id= "actions">
                      <div>
                      <a href="editstory.php?storyid=<?php echo $row["id"];?>">
                        <i class="fa-solid fa-pen-to-square" ></i>
                        </a>
                        </div>
                        <div>
                        <form action="../st_functions.php" method="post">
                          <input type='hidden' name='storyid' value="<?php echo $row["id"];?>" />
                      <button name="deletestory" type="submit" style="float: right;" >
                        <i class="fa-solid fa-trash-can" ></i>
                            </button>
                        </form>
                    </div>
                    </td> 
                  </tr>

                  <?php 
                $i++;
                }  ?>
                </tbody>
                </table>    
                
                <!-- Profile Modal-->
          <div id="ProfileModal" tabindex="-1" role="dialog" aria-labelledby="ProfileModalLabel" aria-hidden="true" class="modal fade text-left">
            <div role="document" class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 id="ProfileModalLabel" style="color: #004ef9;" class="modal-title navbar-brand font-weight-bold text-uppercase text-base">Your Profile</h4>
                  <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                  <p>Signed in as @firstname+lastname</p>
                    <div class="form-group">
                        <label for="img">Profile Picture</label>
                      </div>
                      <div class="line"></div>
                    <div class="form-group">
                        <label>Firstname</label>
                      </div>
                      <div class="line"></div>
                      <div class="form-group">
                        <label>Lastname</label>
                      </div>
                </div>
                <div class="modal-footer">
                  <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
                </div>
              </div>
            </div>
          </div>


               <!--Edit Profile Modal-->
          <div id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true" class="modal fade text-left">
            <div role="document" class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 id="editProfileModalLabel" style="color: #004ef9;" class="modal-title navbar-brand font-weight-bold text-uppercase text-base">Edit Profile</h4>
                  <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
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
        <div id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="changePasswordModalLabel" aria-hidden="true" class="modal fade text-left">
            <div role="document" class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                    <h4 id="changePasswordModalLabel" style="color: #004ef9;" class="modal-title navbar-brand font-weight-bold text-uppercase text-base">Change Password</h4>

                  <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
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
                  <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
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

          <!-- Delete Story Modal-->
          <div id="deleteStoryModal" tabindex="-1" role="dialog" aria-labelledby="deleteStoryModalLabel" aria-hidden="true" class="modal fade text-left">
            <div role="document" class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 id="deleteStoryModalLabel" style="color: #004ef9;" class="modal-title navbar-brand font-weight-bold text-uppercase text-base">Delete Story</h4>
                  <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                <form>
                <input type="hidden" name="story_id" value="">
                    <!-- GET CONTENT FOR LOREM -->
                  <p>Do you want to delete this story of title ---> get from back after passing id of story </p>       
                  <!-- <input type="text" name="story_id" value="" -->
                <div class="modal-footer">
                  <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
                  <button type="button" name="deleteStory" id="btndeletestory" data-dismiss="modal" class="btn btn-primary">Yes</button>
                  </form>
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
    <script src="../vendor/sweetalert/sweetalert.min.js"></script>
    <!-- JavaScript files-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/popper.js/umd/popper.min.js"> </script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://kit.fontawesome.com/5da43224bf.js" crossorigin="anonymous"></script>
    <script src="../vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="../vendor/chart.js/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
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
     <!-- Jquery datatables -->
     <script type="text/javascript" charset="utf8" src="../sort.js"></script>
     <!-- <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script> -->
     <!-- <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/searchpanes/2.0.0/js/dataTables.searchPanes.min.js"></script> -->
     <!-- <script>
       $(function() {
         $("#myStoriesTable").dataTable();
       } );
     </script> -->
     <?php include("../footer.php")?>


  </body>
</html>
    
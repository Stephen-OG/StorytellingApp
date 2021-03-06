<?php

      include("../connection.php");
      include("../functions.php");
      include("../admin_functions.php");
      
      $admin_check = get_admin_by_id($con);
      $active_users = active_users($con);
      $inactive_users = inactive_users($con);
      $total_users = all_storytellers($con);
      $published_stories = admin_published_stories($con);
      $pending_stories = admin_pending_stories($con);
      $rejected_stories = admin_rejected_stories($con);
      $total_stories = admin_total_stories($con);
      $all_stories = all_stories($con);
      $all_storytellers = all_users($con);

?>


<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../custom/custom.css">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Index | Admin</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <link href="../css/dataTables.bootstrap.css" rel="stylesheet" />
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <!-- jQuery Datatable -->
    <link rel="stylesheet" href="../css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css" />
   

    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"> -->
    <!-- <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> -->

    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome CSS-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css"
        integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
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
    <!-- Tweaks for older IEs-->
    <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
</head>

<body>
    <!-- navbar-->
    <header class="header">
        <nav class="navbar navbar-expand-lg px-4 py-2 bg-white shadow"><a href="#"
                class="sidebar-toggler text-gray-500 mr-4 mr-lg-5 lead"><i class="fas fa-align-left"></i></a><a
                href="#home" class="navbar-brand font-weight-bold text-uppercase text-base">Story Telling App</a>
            <ul class="ml-auto d-flex align-items-center list-unstyled mb-0">


                <li class="nav-item dropdown ml-auto"><a id="userInfo" href="http://example.com" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><img id="profileImage"
                            src="" style="max-width: 2.5rem;"
                            class="img-fluid rounded-circle shadow"></a>
                    <div aria-labelledby="userInfo" class="dropdown-menu"><a href="#" class="dropdown-item"><strong
                                class="d-block text-uppercase headings-font-family"><?php echo $admin_check['FirstName'];?>  <?php echo $admin_check['LastName'];?>
                                </strong><small>Admin</small></a>
                        
                        <div class="dropdown-divider"></div>
                        <a href="../index.php" class="dropdown-item">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
    </header>
    <div class="d-flex align-items-stretch">
        <div id="sidebar" class="sidebar py-3">
            <div class="text-gray-400 text-uppercase px-3 px-lg-4 py-4 font-weight-bold small headings-font-family">MAIN
            </div>
            <ul class="sidebar-menu list-unstyled">
                <!-- GET APPROPRIATE ICONS -->
                <li class="sidebar-list-item"><a href="#home" class="sidebar-link text-muted"><i
                            class="o-home-1 mr-3 text-gray"></i><span>Home</span></a></li>
                <li class="sidebar-list-item"><a href="#stories" class="sidebar-link text-muted"><i
                            class="o-paper-stack-1 mr-3 text-gray"></i><span>Stories</span></a></li>
                <li class="sidebar-list-item"><a href="#users" class="sidebar-link text-muted"><i
                            class="o-user-1 mr-3 text-gray"></i><span>Users</span></a></li>

            </ul>
            <!-- <div class="text-gray-400 text-uppercase px-3 px-lg-4 py-4 font-weight-bold small headings-font-family">EXTRAS</div>
        <ul class="sidebar-menu list-unstyled">
              <li class="sidebar-list-item"><a href="#" class="sidebar-link text-muted"><i class="o-database-1 mr-3 text-gray"></i><span>Ratings and Reviews</span></a></li>
        </ul> -->
        </div>
        <div class="page-holder w-100 d-flex flex-wrap">
            <div class="container-fluid px-xl-5">
                <section class="py-5" id="home">
                    <div class="row">
                        <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
                            <div
                                class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
                                <div style="display: inline !important;">
                                    <div class="dot mr-3 bg-green"></div>
                                    <div class="text" style="margin-left: 4px;">
                                        <h6 class="mb-0" style="color: #212529; text-align: left; margin-left: 4px;">
                                            Approved Stories</h6><span class="text-gray"
                                            style="font-size:smaller; float: left; margin-left: 4px;"><?php echo $published_stories;?> / <?php echo $total_stories;?></span>
                                    </div>
                                </div>
                                <div class="icon text-white bg-green col-md-3"><i class="fas fa-check-circle"></i></div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
                            <div
                                class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
                                <div class="flex-grow-1 d-flex align-items-center">
                                    <div class="dot mr-3 bg-red"></div>
                                    <div class="text" style="margin-left: 4px;">
                                        <h6 class="mb-0" style="color: #212529; text-align: left; margin-left: 4px;">
                                            Disapproved Stories</h6><span class="text-gray"
                                            style="font-size:smaller; float: left; margin-left: 4px;"><?php echo $rejected_stories;?> / <?php echo $total_stories;?></span>
                                    </div>
                                </div>
                                <div class="icon text-white bg-red"><i class="fas fa-exclamation-circle"></i></div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
                            <div
                                class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
                                <div class="flex-grow-1 d-flex align-items-center">
                                    <div class="dot mr-3 bg-blue"></div>
                                    <div class="text" style="margin-left: 4px;">
                                        <h6 class="mb-0" style="color: #212529; text-align: left; margin-left: 4px;">
                                            Activated Users</h6><span class="text-gray"
                                            style="font-size:smaller; float: left; margin-left: 4px;"><?php echo $active_users;?> / <?php echo $total_users;?></span>
                                    </div>
                                </div>
                                <div class="icon text-white bg-blue"><i class="fas fa-check-circle"></i></div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6 mb-4 mb-xl-0">
                            <div
                                class="bg-white shadow roundy p-4 h-100 d-flex align-items-center justify-content-between">
                                <div class="flex-grow-1 d-flex align-items-center">
                                    <div class="dot mr-3 bg-red"></div>
                                    <div class="text" style="margin-left: 4px;">
                                        <h6 class="mb-0" style="color: #212529; text-align: left; margin-left: 4px;">
                                            Deactivated Users</h6><span class="text-gray"
                                            style="font-size:smaller; float: left; margin-left: 4px;"><?php echo $inactive_users;?>  / <?php echo $total_users;?></span>
                                    </div>
                                </div>
                                <div class="icon text-white bg-red"><i class="fas fa-exclamation-circle"></i></div>
                            </div>
                        </div>

                    </div>
                </section>

                <section class="py-5" id="stories">
                    <div class="col-lg-12 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="text-uppercase mb-0">All Stories</h6>
                            </div>
                            <div class="card-body" style="overflow-x: auto;">
                                <table class="table table-hover card-text" id="storiesTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Location</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    
                                        <?php 
                                            $i=1;
                                            while($row = mysqli_fetch_array($all_stories) )
                                            {
                                            ?>
                                        <tr>
                                            <th scope="row"><?php echo $i ?></th>
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
                                            
                                            ?>
                                            </td>
                                            <td><a href="details.php?storyid=<?php echo $row["id"]; ?>">Details</a></td>
                                        </tr>
                                        <?php 
                                            $i++;
                                            }  ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="py-5" id="users">

                    <div class="col-lg-12 mb-4">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="text-uppercase mb-0">All Story Tellers</h6>
                            </div>
                            <div class="card-body" style="overflow-x: auto;">
                                <table class="table table-hover card-text" id="usersTable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Email</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                        $i=1;
                                        while($row = mysqli_fetch_array($all_storytellers) )
                                        {
                                        ?>
                                        <tr>
                                            <th scope="row"><?php echo $i ?></th>
                                            <td><?php echo $row["FirstName"]; ?></td>
                                            <td><?php echo $row["LastName"]; ?></td>
                                            <td><?php echo $row["Email"]; ?></td>
                                            <td><?php if($row["isActive"] == 1)
                                            {
                                                echo "<div class='icon text-white bg-blue'><i
                                                        class='fas fa-check-circle'></i></div>";
                                            }elseif($row["isActive"] == 0)
                                            {
                                                echo "<div class='icon text-white bg-red'><i
                                                        class='fas fa-check-circle'></i></div>";
                                            }                                  
                                            
                                            ?></td>
                                            <td><a href="users.php?userid=<?php echo $row["id"]; ?>">Profile Details</a></td>
                                        </tr>
                                        <?php 
                                        $i++;
                                        }  ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
            </div>


            <!--Edit Profile Modal-->
            <div id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel"
                aria-hidden="true" class="modal fade text-left">
                <div role="document" class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 id="editProfileModalLabel" style="color: #004ef9;"
                                class="modal-title navbar-brand font-weight-bold text-uppercase text-base">Edit Profile
                            </h4>
                            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                                    aria-hidden="true">??</span></button>
                        </div>
                        <div class="modal-body">
                            <p>Signed in as Mark Stephen</p>
                            <form>
                                <div class="form-group">
                                    <label for="img">Profile Picture</label>
                                    <input type="file" id="img" name="img" accept="image/*" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Firstname</label>
                                    <input type="text" placeholder="Firstname" id="firstname" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Lastname</label>
                                    <input type="text" placeholder="Lastname" id="lastname" class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="submit" id="btneditprofile" value="Update" class="btn btn-primary">
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
                                class="modal-title navbar-brand font-weight-bold text-uppercase text-base">Change
                                Password</h4>

                            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                                    aria-hidden="true">??</span></button>
                        </div>
                        <div class="modal-body">
                            <form>
                                <div class="form-group">
                                    <label>Old Password</label>
                                    <input type="password" placeholder="Old Password" id="oldpassword"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>New Password</label>
                                    <input type="password" placeholder="New Password" id="newpassword"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Confirm New Password</label>
                                    <input type="password" placeholder="Confirm New Password" id="confirnnewpassword"
                                        class="form-control">
                                </div>
                                <div class="form-group">
                                    <input type="submit" id="btnchangepassword" value="Save Changes"
                                        class="btn btn-primary">
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
            <div id="deleteAccountModal" tabindex="-1" role="dialog" aria-labelledby="deleteAccountModalLabel"
                aria-hidden="true" class="modal fade text-left">
                <div role="document" class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 id="deleteAccount" style="color: #004ef9;"
                                class="modal-title navbar-brand font-weight-bold text-uppercase text-base">Delete
                                Account</h4>
                            <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                                    aria-hidden="true">??</span></button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure you want to delete your account?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="btndeletestory" data-dismiss="modal"
                                class="btn btn-primary">Yes</button>
                            <button type="button" data-dismiss="modal" class="btn btn-secondary">No</button>
                        </div>
                    </div>
                </div>
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
    <script>
        $(document).ready(function () {
            $('#storiesTable').DataTable({
              "paging":false
            });
        });

        $(document).ready(function () {
            $('#usersTable').DataTable({
                "bPaginate": false,
             
            });
        });
    </script>
    <script src="../vendor/jquery/jquery.min.js"></script>

     <!--Data Table-->

     <script src="../scripts/jquery.dataTables.min.js"></script>
     <script src="../scripts/dataTables.bootstrap.js"></script>
     <script src="../scripts/jquery.dataTables.buttons.min.js"></script>
     <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.colVis.min.js"></script>
     <script src="../scripts/jquery.buttons.html5.min.js"></script>
     <script src="../scripts/jquery.jszip.min.js"></script>
     <script src="../scripts/jquery.buttons.print.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="../vendor/popper.js/umd/popper.min.js"> </script>
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>
    <script src="../vendor/jquery.cookie/jquery.cookie.js"> </script>
    <script src="../vendor/chart.js/Chart.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
    <script src="../js/front.js"></script>

    <script type='text/javascript'>
      //use alternative image if Profile Image not found
      document.getElementById('profileImage').src="../uploads/<?php echo $admin_check['ProfileImage'];?>";

      document.getElementById('profileImage').onload = function() { 
      }

      document.getElementById('profileImage').onerror = function() { 
        document.getElementById('profileImage').src="../img/avatar-6.jpg"; 
      }
    </script>
    <?php include("../footer.php")?>
   
</body>

</html>
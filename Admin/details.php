<?php 

            include("../connection.php");
            include("../functions.php");
            include("../st_functions.php");
            include("../admin_functions.php");
        
            $story = get_story_by_id($con);
            
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="../custom/custom.css">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin | Story Details</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">

    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../fashe/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../fashe/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,800">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>

    <link rel="stylesheet" type="text/css" href="../fashe/fonts/themify/themify-icons.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../fashe/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../fashe/fonts/elegant-font/html-css/style.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../fashe/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../fashe/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../fashe/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../fashe/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../fashe/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../fashe/vendor/slick/slick.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../fashe/vendor/lightbox2/css/lightbox.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="../fashe/css/util.css">
    <link rel="stylesheet" type="text/css" href="../fashe/css/main.css">
    <!--===============================================================================================-->

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
                href="index.php?adminid=39" class="navbar-brand font-weight-bold text-uppercase text-base">Story Telling App</a>
            <ul class="ml-auto d-flex align-items-center list-unstyled mb-0">

            </ul>
        </nav>
    </header>
    <div class="d-flex align-items-stretch">
        <div id="sidebar" class="sidebar py-3">
            <div class="text-gray-400 text-uppercase px-3 px-lg-4 py-4 font-weight-bold small headings-font-family">MAIN
            </div>
            <ul class="sidebar-menu list-unstyled">
                <!-- GET APPROPRIATE ICONS -->
                <li class="sidebar-list-item"><a href="index.php?adminid=39#home" class="sidebar-link text-muted"><i
                            class="o-home-1 mr-3 text-gray"></i><span>Home</span></a></li>
                <li class="sidebar-list-item"><a href="index.php?adminid=39#stories" class="sidebar-link text-muted"><i
                            class="o-paper-stack-1 mr-3 text-gray"></i><span>Stories</span></a></li>
                <li class="sidebar-list-item"><a href="index.php?adminid=39#users" class="sidebar-link text-muted"><i
                            class="o-user-1 mr-3 text-gray"></i><span>Users</span></a></li>

            </ul>
        </div>
        <div class="page-holder w-100 d-flex flex-wrap">
            <div class="container-fluid px-xl-5">
                <section class="py-5" id="home">
                    <!-- Product Detail -->
                    <div class="container bgwhite p-t-35 p-b-80">
                        <div class="flex-w flex-sb">
                            <div class="w-size13 p-t-30 respon5">
                                <div class="wrap-slick3 flex-sb flex-w">
                                    <div class="wrap-slick3-dots"></div>

                                    <div class="slick3">
                                        <div class="item-slick3" data-thumb="fashe/images/dune.jpg">
                                            <div class="thumb-pic" style="margin: 0 auto;">
                                            <img src="../uploads/<?php echo $story['ImageName'];?>">
                                            </div>
                                        </div>

                                        <!-- <div class="item-slick3" data-thumb="fashe/images/dune.jpg">
                                            <div class="wrap-pic-w">
                                                <img src="fashe/images/dune.jpg" alt="IMG-PRODUCT">
                                            </div>
                                        </div> -->

                                        <!-- <div class="item-slick3" data-thumb="fashe/images/dune.jpg">
                                            <div class="wrap-pic-w">
                                                <img src="fashe/images/dune.jpg" alt="IMG-PRODUCT">
                                            </div>
                                        </div> -->
                                    </div>
                                </div>
                            </div>

                            <div class="w-size14 p-t-30 respon5">
                                <h4 class="product-detail-name m-text16 p-b-13" style="font-family: 'poppins';">
                                <?php echo $story['Title'];
                                ?>
                                </h4>

                                <span class="m-text17" style="font-family: 'poppins';">
                                <?php echo $story['Category'];
                                ?>
                                </span>

                                <p class="s-text8 p-t-10" style="font-family: 'poppins';">
                                <?php echo $story['Location'];
                                ?>
                                </p>

                                <p class="s-text8 p-t-10" style="display: inline-block; font-family: 'poppins';">
                                    Status: &nbsp; 
                                    <?php if($story["StoryStatus"] == 'Approved')
                                            {
                                                echo "<div class='icon text-white bg-green'><i
                                                        class='fas fa-check-circle'></i></div>";
                                            }elseif($story["StoryStatus"] == 'Pending')
                                            {
                                                echo "<div class='icon text-white bg-orange'><i
                                                        class='fas fa-check-circle'></i></div>";
                                            }elseif($story["StoryStatus"] == 'Rejected')
                                            {
                                                echo "<div class='icon text-white bg-red'><i
                                                        class='fas fa-check-circle'></i></div>";
                                            };                                    
                                            
                                            ?>
                                </p>


                                <div class="wrap-dropdown-content bo6 p-t-15 p-b-14 active-dropdown-content">
                                    <h5
                                        class="js-toggle-dropdown-content flex-sb-m cs-pointer m-text19 color0-hov trans-0-4" style="font-family: 'poppins';">
                                        Description
                                        <!-- <i class="down-mark fs-12 color1 fa fa-minus" aria-hidden="true"></i>
                                        <i class="up-mark fs-12 color1 fa fa-plus" aria-hidden="true"></i> -->
                                    </h5>

                                    <div class="dropdown-content p-t-15 p-b-23">
                                        <p class="s-text8" style="font-family: 'poppins';">
                                        <?php echo $story['Body'];
                                ?>
                                        </p>
                                    </div>
                                </div>
                                <div class="w-size16 flex-m flex-w">


                                    <div>
                                        <!-- Button -->
                                        <br>
                                        <form method="post">
                                        <input type='hidden' name='storyid' value="<?php echo $story["id"];?>" />
                                        <button name="approvebtn" type="submit" class="btn btn-primary" style="float: left;">
                                            Approve
                                        </button>
                                        <button name="disapprovebtn" type="submit" class="btn btn-secondary" style="float: left; margin-left: 5px;">
                                            Disapprove
                                        </button>
                                        </form>
                                    </div>

                                  
                                </div>

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
                                    aria-hidden="true">×</span></button>
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
                                    aria-hidden="true">×</span></button>
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
                                    aria-hidden="true">×</span></button>
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
                            <p class="mb-2 mb-md-0" style="color: #004ef9;">Story Telling App &copy; 2022</p>
                        </div>
                        <div class="col-md-6 text-center text-md-right text-gray-400">


                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- JavaScript files-->
    <!-- <script>
        $(document).ready(function () {
            $('#storiesTable').DataTable({
                "paging": true,
                "pagingType": "full_numbers"
            });
        });

        $(document).ready(function () {
            $('#usersTable').DataTable({
                "paging": true,
                //"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
                // "dom": '<"top"i>rt<"bottom"flp><"clear">',
                "pagingType": "full_numbers"
            });
        });
    </script> -->
    <script src="../vendor/sweetalert/sweetalert.min.js"></script>
    <script src="../custom/custom.js"></script>
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
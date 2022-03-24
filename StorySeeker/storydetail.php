<?php
session_start();

        include("../connection.php");
        include("../functions.php");
        include("../st_functions.php");
        include("../ss_functions.php");

      $check_login = user_login_check($con);
      $update_profile = updateProfile($con);
      $change_password = change_password($con);
      $populate_story = get_story_by_id($con);

      $story_user_profile = story_teller_details($con);
      $read_stories = save_read_stories($con);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Story Detail | Story Seeker</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
</head>

<body>

    <!-- navbar-->
    <header class="header">
        <nav class="navbar navbar-expand-lg px-4 py-2 bg-white shadow"><a href="#"
                class="sidebar-toggler text-gray-500 mr-4 mr-lg-5 lead"></a><a href="index.php"
                class="navbar-brand font-weight-bold text-uppercase text-base">Story telling App</a>
            <ul class="ml-auto d-flex align-items-center list-unstyled mb-0">

                <li class="nav-item">
                    <form id="searchForm" class="ml-auto d-none d-lg-block">
                        <div class="form-group position-relative mb-0">
                            <p class="mb-0">Hi <?php echo $check_login['FirstName'];?>, &nbsp;</p>
                            
                        </div>
                    </form>
                </li>

                <li class="nav-item dropdown mr-3"><a id="notifications" href="http://example.com"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        class="nav-link dropdown-toggle text-gray-400 px-1"><i class="fa fa-edit"></i></a>
                    <div aria-labelledby="notifications" class="dropdown-menu"><a href="../StoryTeller/signup.php"
                            class="dropdown-item">
                            <div class="d-flex align-items-center">
                                <div class="icon icon-sm bg-blue text-white"><i class="fas fa-upload"></i></div>
                                <div class="text ml-2">
                                    <p class="mb-0">Write a story</p>
                                </div>
                            </div>
                        </a>
                        <!-- <div class="dropdown-divider"></div><a href="#" class="dropdown-item text-center"><small class="font-weight-bold headings-font-family text-uppercase">View all notifications</small></a> -->
                    </div>
                </li>

                <li class="nav-item dropdown ml-auto"><a id="userInfo" href="http://example.com" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle"><img id="profileImage"
                            src="" style="max-width: 2.5rem;"
                            class="img-fluid rounded-circle shadow"></a>
                    <div aria-labelledby="userInfo" class="dropdown-menu"><a href="#" class="dropdown-item"><strong
                                class="d-block text-uppercase headings-font-family"><?php echo $check_login['FirstName'];?> <?php echo $check_login['LastName'];?></strong><small>Story
                                Seeker</small></a>
                        <div class="dropdown-divider"></div>
                        <!-- <a data-toggle="modal" data-target="#changePasswordModal" class="dropdown-item">Write a Story</a> -->
                        <!-- <hr> -->
                        <a href="index.php" class="dropdown-item">Home</a>
                        <a data-toggle="modal" data-target="#editProfileModal" class="dropdown-item">Edit Profile</a>
                        <a href="categories.php?category=history" class="dropdown-item">Categories</a>
                        <a href="savedstories.php" class="dropdown-item">Saved Stories</a>
                        <a href="readstories.php" class="dropdown-item">Read Stories</a>
                        <a data-toggle="modal" data-target="#changePasswordModal" class="dropdown-item">Change Password</a>
                        <!-- <a data-toggle="modal" data-target="#changePasswordModal" class="dropdown-item">Write A Story</a> -->
                        <a data-toggle="modal" data-target="#deleteAccountModal" class="dropdown-item">Delete Account</a>
                        <div class="dropdown-divider"></div>
                        <a href="signin.php" class="dropdown-item">Logout</a>
                    </div>
                </li>
            </ul>
        </nav>
    </header>

    <!-- content page -->
    <section class="bgwhite p-t-60 p-b-25">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-lg-9 p-b-80">
                    <div class="p-r-50 p-r-0-lg">
                        <div class="p-b-40">
                            <div class="blog-detail-img wrap-pic-w">
                                <img src="../uploads/<?php echo $populate_story['ImageName'];
                                ?>" alt="IMG-BLOG">
                            </div>

                            <div class="blog-detail-txt p-t-33">
                                <h4 class="p-b-11 m-text24" style="font-family: 'Poppins';">
                                <?php echo $populate_story['Title'];
                                ?>
                                </h4>

                                <div class="s-text8 flex-w flex-m p-b-21" style="font-family: 'Poppins';">
                                    <span>
                                        By <?php echo $story_user_profile['FirstName']; ?> <?php echo $story_user_profile['LastName']; ?>
                                        <span class="m-l-3 m-r-6">|</span>
                                    </span>

                                    <span>
                                        <?php echo $populate_story['CreatedDate'];
                                ?>
                                        <span class="m-l-3 m-r-6">|</span>
                                    </span>

                                    <span>
                                        Category, <?php echo $populate_story['Category'];
                                ?>
                                        <span class="m-l-3 m-r-6">|</span>
                                    </span>

                                    <span>
                                        8 Reviews
                                    </span>
                                </div>

                                <p class="p-b-25">
                                <?php echo $populate_story['Body'];
                                ?>               
                                </p>
                            </div>

                            
                        </div>

                        <!-- Leave a review -->
                        <form class="leave-comment">
                            <h4 class="m-text25 p-b-14" style="font-family: 'Poppins';">
                                Leave a Review
                            </h4>

                            <div class="flex-m flex-w p-t-20" style="margin-bottom: 15px;">
                                <span class="s-text20 p-r-20" style="font-family: 'Poppins';">
                                    <i class="fas fa-star"></i> Ratings
                                </span>

                                <div class="wrap-tags flex-w">
                                    <a href="#" class="tag-item" style="text-decoration: none;" style="font-family: 'Poppins';">
                                        1 Star
                                    </a>

                                    <a href="#" class="tag-item" style="text-decoration: none;" style="font-family: 'Poppins';">
                                        2 Stars
                                    </a>

                                    <a href="#" class="tag-item" style="text-decoration: none;" style="font-family: 'Poppins';">
                                        3 Stars
                                    </a>

                                    <a href="#" class="tag-item" style="text-decoration: none;" style="font-family: 'Poppins';">
                                        4 Stars
                                    </a>

                                    <a href="#" class="tag-item" style="text-decoration: none;" style="font-family: 'Poppins';">
                                        5 Stars
                                    </a>
                                </div>
                            </div>

                            <textarea style="font-family: 'poppins';" id= "Review" class="dis-block s-text7 size18 bo12 p-l-18 p-r-18 p-t-13 m-b-20" name="comment"
                                placeholder="Leave a Review..."></textarea>

                            <div class="w-size24">
                                <!-- Button -->
                                <button class="flex-c-m size1 bg1 bo-rad-20 hov1 s-text1 trans-0-4" style="font-family: 'poppins';">
                                    Post Review
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-4 col-lg-3 p-b-80">
                    <div class="rightbar">
                        

                        <!-- Categories -->
                        <h4 class="m-text23 p-t-56 p-b-34" style="font-family: 'poppins';">
                            Categories
                        </h4>

                        <ul>
                            <li class="p-t-6 p-b-8 bo6">
                                <a href="categories.php?category=fiction" class="s-text13 p-t-5 p-b-5" style="font-family: 'poppins';">
                                    Fiction
                                </a>
                            </li>

                            <li class="p-t-6 p-b-8 bo7">
                                <a href="categories.php?category=non-fiction" class="s-text13 p-t-5 p-b-5" style="font-family: 'poppins';">
                                    Non-Fiction
                                </a>
                            </li>

                            <li class="p-t-6 p-b-8 bo7">
                                <a href="categories.php?category=fables" class="s-text13 p-t-5 p-b-5" style="font-family: 'poppins';">
                                    Fables
                                </a>
                            </li>

                            <li class="p-t-6 p-b-8 bo7">
                                <a href="categories.php?category=history" class="s-text13 p-t-5 p-b-5" style="font-family: 'poppins';">
                                    History
                                </a>
                            </li>

                            <li class="p-t-6 p-b-8 bo7">
                                <a href="categories.php?category=comic" class="s-text13 p-t-5 p-b-5" style="font-family: 'poppins';">
                                    Comic
                                </a>
                            </li>

                            <li class="p-t-6 p-b-8 bo7">
                                <a href="categories.php?category=fairy tale" class="s-text13 p-t-5 p-b-5" style="font-family: 'poppins';">
                                    Fairy Tale
                                </a>
                            </li>

                            <li class="p-t-6 p-b-8 bo7">
                                <a href="categories.php?category=short story" class="s-text13 p-t-5 p-b-5" style="font-family: 'poppins';">
                                    Short Story
                                </a>
                            </li>

                            <li class="p-t-6 p-b-8 bo7">
                                <a href="categories.php?category=tragedy" class="s-text13 p-t-5 p-b-5" style="font-family: 'poppins';">
                                    Tragedy
                                </a>
                            </li>
                        </ul>

                        <!-- Recommended Books -->
                        <h4 class="m-text23 p-t-65 p-b-34">
                            Recommendations
                        </h4>

                        <ul class="bgwhite">
                            <li class="flex-w p-b-20">
                                <a href="storydetail.html"
                                    class="dis-block wrap-pic-w w-size22 m-r-20 trans-0-4 hov4">
                                    <img src="../fashe/images/memory.jpg" alt="IMG-PRODUCT">
                                </a>

                                <div class="w-size23 p-t-5">
                                    <a href="storydetail.html" class="s-text20" style="font-family: 'poppins';">
                                        Title of Story
                                    </a>

                                    <span class="dis-block s-text17 p-t-6" style="font-family: 'poppins';">
                                        Type of Story
                                    </span>
                                </div>
                            </li>

                            <li class="flex-w p-b-20">
                                <a href="storydetail.html"
                                    class="dis-block wrap-pic-w w-size22 m-r-20 trans-0-4 hov4">
                                    <img src="../fashe/images/kod.jpg" alt="IMG-PRODUCT">
                                </a>

                                <div class="w-size23 p-t-5">
                                    <a href="storydetail.html" class="s-text20" style="font-family: 'poppins';">
                                        Title of Story
                                    </a>

                                    <span class="dis-block s-text17 p-t-6" style="font-family: 'poppins';"> 
                                        Type of Story
                                    </span>
                                </div>
                            </li>

                            <li class="flex-w p-b-20">
                                <a href="storydetail.html"
                                    class="dis-block wrap-pic-w w-size22 m-r-20 trans-0-4 hov4">
                                    <img src="../fashe/images/sin.jpg" alt="IMG-PRODUCT">
                                </a>

                                <div class="w-size23 p-t-5">
                                    <a href="storydetail.html" class="s-text20">
                                        Title of Story
                                    </a>

                                    <span class="dis-block s-text17 p-t-6">
                                        Type of Story
                                    </span>
                                </div>
                            </li>

                            <li class="flex-w p-b-20">
                                <a href="storydetail.html"
                                    class="dis-block wrap-pic-w w-size22 m-r-20 trans-0-4 hov4">
                                    <img src="../fashe/images/hypocrite.jpg" alt="IMG-PRODUCT">
                                </a>

                                <div class="w-size23 p-t-5">
                                    <a href="storydetail.html" class="s-text20">
                                        Title of Story
                                    </a>

                                    <span class="dis-block s-text17 p-t-6">
                                        Type of Story
                                    </span>
                                </div>
                            </li>

                            <li class="flex-w p-b-20">
                                <a href="storydetail.html"
                                    class="dis-block wrap-pic-w w-size22 m-r-20 trans-0-4 hov4">
                                    <img src="../fashe/images/dragon.jpeg" alt="IMG-PRODUCT">
                                </a>

                                <div class="w-size23 p-t-5">
                                    <a href="storydetail.html" class="s-text20">
                                        Title of Story
                                    </a>

                                    <span class="dis-block s-text17 p-t-6">
                                        Type of Story
                                    </span>
                                </div>
                            </li>
                        </ul>

                     
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- Footer -->
    <footer class="footer bg-white shadow align-self-end py-3 px-xl-5 w-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 text-center text-md-left text-primary">
                    <p style="color: #4680ff; text-align: center;" class="mb-2 mb-md-0">Story Telling App &copy; 2022
                    </p>
                </div>
                <div class="col-md-6 text-center text-md-right text-gray-400">


                </div>
            </div>
        </div>
    </footer>



    <!-- Back to top -->
    <div class="btn-back-to-top bg0-hov" id="myBtn">
        <span class="symbol-btn-back-to-top">
            <i class="fa fa-arrow-up" aria-hidden="true"></i>
        </span>
    </div>

    <!-- Container Selection1 -->
    <div id="dropDownSelect1"></div>

    <!--Edit Profile Modal-->
    <div id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModalLabel" aria-hidden="true"
        class="modal fade text-left">
        <div role="document" class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 id="editProfileModalLabel" style="color: #004ef9;"
                        class="modal-title navbar-brand font-weight-bold text-uppercase text-base">Edit Profile</h4>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <!-- GET CONTENT FOR LOREM -->
                    <p>Lorem ipsum dolor sit amet consectetur.</p>
                    <form method="POST" enctype="multipart/form-data">
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
                            aria-hidden="true">×</span></button>
                </div>
                <div class="modal-body">
                    <!-- GET CONTENT FOR LOREM -->
                    <p>Lorem ipsum dolor sit amet consectetur.</p>
                    <form>
                        <div class="form-group">
                            <label>Old Password</label>
                            <input type="password" placeholder="Old Password" id="oldpassword" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" placeholder="New Password" id="newpassword" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Confirm New Password</label>
                            <input type="password" placeholder="Confirm New Password" id="confirnnewpassword"
                                class="form-control">
                        </div>
                        <div class="form-group">
                            <input type="submit" id="btnchangepassword" value="Save Changes" class="btn btn-primary">
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
                        class="modal-title navbar-brand font-weight-bold text-uppercase text-base">Delete Account</h4>
                    <button type="button" data-dismiss="modal" aria-label="Close" class="close"><span
                            aria-hidden="true">×</span></button>
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

    <!-- Javascript Files -->
    <script src="../address.js"></script>
    <script>
        document.getElementById("storyLocation").addEventListener("submit", function (e) {
            e.preventDefault()
            /*
               the longitude and latitude values are automatically returned by the api and that's what you need 
               to store in your database. 
              
               You can then use the stored lon and lat values to retrieve the address later. check the getAddress.js file,
               you will see how that works. 
              
               
              */
            let longitude = chosenLocation.lon;
            let latitude = chosenLocation.lat;
            console.log(longitude);
            let location = chosenLocation.city + ", " + chosenLocation.county;
            console.log(location);

            //let category = document.getElementById("categoryChosen").value;
            let url = "{% url 'search' 3 99999999999 99999999991 22222222222 %}"
            // url = url.replace("3", category)
            // url = url.replace("99999999999", longitude)
            // url = url.replace("99999999991", latitude)
            // url = url.replace("22222222222", location)
            // document.location.href = url;

            var data = {

                storyLocation: location,


            }


            console.log(data);
            if (data.storyLocation != "") {
                createStory();

            }
            else {

                swal("Not yet", "All fields are required!", "warning");

            }

        })
    </script>
    <!--===============================================================================================-->
    <script type="text/javascript" src="../fashe/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script type="text/javascript" src="../fashe/vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script type="text/javascript" src="../fashe/vendor/bootstrap/js/popper.js"></script>
    <script type="text/javascript" src="../fashe/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script type="text/javascript" src="../fashe/vendor/select2/select2.min.js"></script>
    <script type="text/javascript">
        $(".selection-1").select2({
            minimumResultsForSearch: 20,
            dropdownParent: $('#dropDownSelect1')
        });
    </script>
    <!--===============================================================================================-->
    <script type="text/javascript" src="../fashe/vendor/slick/slick.min.js"></script>
    <script type="text/javascript" src="../fashe/js/slick-custom.js"></script>
    <!--===============================================================================================-->
    <script type="text/javascript" src="../fashe/vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script type="text/javascript" src="../fashe/vendor/lightbox2/js/lightbox.min.js"></script>
    <!--===============================================================================================-->
    <script type="text/javascript" src="../fashe/vendor/sweetalert/sweetalert.min.js"></script>
    <script type="text/javascript">
        $('.block2-btn-addcart').each(function () {
            var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
            $(this).on('click', function () {
                // swal(nameProduct, "is added to cart !", "success");
            });
        });

        $('.block2-btn-addwishlist').each(function () {
            var nameProduct = $(this).parent().parent().parent().find('.block2-name').html();
            $(this).on('click', function () {
                swal(nameProduct, "is added to 'read later' !", "success");
            });
        });

        //use alternative image if Profile Image not found
        document.getElementById('profileImage').src="../uploads/<?php echo $check_login['ProfileImage'];?>";
        document.getElementById('profileImage').onload = function() { 
        }
        document.getElementById('profileImage').onerror = function() { 
        document.getElementById('profileImage').src="../img/avatar-6.jpg"; 
        }
    </script>

    <!--===============================================================================================-->
    <script type="text/javascript" src="../fashe/vendor/parallax100/parallax100.js"></script>
    <script type="text/javascript">
        $('.parallax100').parallax100();
    </script>
    <!--===============================================================================================-->
    <script src="../fashe/js/main.js"></script>

</body>

</html>
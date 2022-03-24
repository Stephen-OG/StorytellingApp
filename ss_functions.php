<?php

function get_stories_by_category($con){
    // $categories = array("comic","fables","fiction","fairy tale","history","non-fiction","short story","tragedy","others");
    // $categoriesLength = count($categories);
    // Initialize URL to the variable
    // $url = 'https://www.geeksforgeeks.org/register?name=Amit&email=amit1998@gmail.com';
    $url = $_SERVER['REQUEST_URI'];
    // Use parse_url() function to parse the URL 
    // and return an associative array which
    // contains its various components
    $url_components = parse_url($url);
    
    // Use parse_str() function to parse the
    // string passed via URL
    parse_str($url_components['query'], $params);
    $category = strtolower($params['category']);
    
    return mysqli_query($con,"SELECT * FROM stories WHERE Category = '$category' AND StoryStatus = 1");

}

function story_teller_details($con){
    // I called the get_story_by_id function to edit a story
    $result = get_story_by_id($con);
    $story_teller = mysqli_query($con,"SELECT * FROM users WHERE id = '$result[userid]'");
    return mysqli_fetch_assoc($story_teller);

}

function seeker_stories($con){
    return mysqli_query($con,"SELECT * FROM stories WHERE StoryStatus = 1");
}


function save_story($sid, $uid){
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        // $sid = $_POST['story_id'];
        // $uid = $_POST['user_id'];

        if(empty($sid) && empty($uid))
			{
				//echo "<script>alert('There are no fields to generate a report')</script>"; 
                echo json_encode(array('success' => 3));
                //echo "<script src'https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js'>swal('There are no fields to generate a report', '', 'error')</script>";
			}

            $result = mysqli_query(mysqli_connect("localhost","root","","storytellingdb"), "SELECT * FROM user_saved_stories WHERE StoryId='$sid' ");
            if (mysqli_num_rows($result) > 0 ){

                //header("Location:index.php?error=story already exists")
                //echo "<script src='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js'>swal('Story added', '', 'success')</script>";
                echo json_encode(array('success' => 2));

            }
            else 
            {
                mysqli_query(mysqli_connect("localhost","root","","storytellingdb"), "INSERT INTO user_saved_stories (UserId,StoryId) VALUES ('$uid','$sid')");
                //echo "<script>alert('story added')</script>";
                //echo "<script src='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js'>swal('Story added', '', 'success')</script>";
                echo json_encode(array('success' => 1));

            }
    }
    
}
//before code
// function save_story($con){
//     if($_SERVER['REQUEST_METHOD'] == "POST"){
//         $sid = $_POST['story_id'];
//         $uid = $_POST['user_id'];

//         if(empty($sid) && empty($uid))
// 			{
// 				//echo "<script>alert('There are no fields to generate a report')</script>"; 
//                 echo "<script src'https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js'>swal('There are no fields to generate a report', '', 'error')</script>";
// 			}

//             $result = mysqli_query($con, "SELECT * FROM user_saved_stories WHERE StoryId='$sid' ");
//             if (mysqli_num_rows($result) > 0 ){

//                 //header("Location:index.php?error=story already exists")
//                 echo "<script src='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js'>swal('Story added', '', 'success')</script>";

//             }
//             else 
//             {
//                 mysqli_query($con, "INSERT INTO user_saved_stories (UserId,StoryId) VALUES ('$uid','$sid')");
//                 //echo "<script>alert('story added')</script>";
//                 echo "<script src='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js'>swal('Story added', '', 'success')</script>";

//             }
//     }
    
// }

function saved_stories($con){
    if(isset($_SESSION['id']))
		{
            $id = $_SESSION['id'];
            return mysqli_query($con,"SELECT * FROM user_saved_stories WHERE UserId = '$id'");
        }
}


function delete_saved_stories($con){
    if($_SERVER['REQUEST_METHOD'] == "POST"){
		{
            $storyid = $_POST['storyid'];


            mysqli_query($con,"DELETE FROM user_saved_stories WHERE StoryId = '$storyid' ");
            header("Location:savedstories.php?story deleted");

        }
    }
}

function save_read_stories($con) {
    if(isset($_SESSION['id']))
		{
			$user_id = $_SESSION['id'];

            $result = get_story_by_id($con);

            $saved_story = mysqli_query($con,"SELECT * FROM user_read_stories WHERE UserId = '$user_id' AND StoryId = '$result[id]'");
            if(mysqli_num_rows($saved_story) > 0){

                echo "<script src='https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js'>swal('Story added', '', 'success')</script>";

                }
                mysqli_query($con, "INSERT INTO user_read_stories (UserId,StoryId) VALUES ('$user_id','$result[id]')");
            }
}

function read_stories($con){
    if(isset($_SESSION['id']))
		{
            $id = $_SESSION['id'];
            return mysqli_query($con,"SELECT * FROM user_read_stories WHERE UserId = '$id'");
        }
}

function delete_read_stories($con){
    if($_SERVER['REQUEST_METHOD'] == "POST"){
		{
            $storyid = $_POST['storyid'];

            mysqli_query($con,"DELETE FROM user_read_stories WHERE StoryId = '$storyid' ");
            header("Location:readstories.php?story deleted");
        }
    }
}


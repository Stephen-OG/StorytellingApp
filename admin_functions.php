<?php

if(isset($_POST['adminloginbtn'])){
    {
        include("../connection.php");

    //something was posted
    $email = $_POST['email'];
    $password = $_POST['password'];

    $hashedpassword = hash('sha256',$password);

    if(empty($email) && empty($password))
    {
        echo "<script>alert('There are no fields to generate a report')</script>"; 
    }

        //read from database
        $result = mysqli_query($con, "SELECT * FROM users WHERE Email='$email' AND isAdmin=1");

        if($result)
        {
            if($result && mysqli_num_rows($result) > 0)
            {
                $user_data = mysqli_fetch_assoc($result);
                
                if($hashedpassword != $user_data['Password'])
                {
                    $_SESSION['status'] = "Password Do Not Match";
                    $_SESSION['status_code'] = "error";
                    header("Location:signin.php?error=password do not match");
                    die;

                }
                else{

                    $_SESSION['id'] = $user_data['id'];							
                    if($user_data['isAdmin']== 1 ){
                        $_SESSION['status'] = "Logged In";
                        $_SESSION['status_code'] = "success";
                        header("Location:index.php");
                        die;
                    }
                    
                    else{
                    $_SESSION['status'] = "User Not Found";
                    $_SESSION['status_code'] = "warning";
                    header("Location:signin.php?user not found");	
                    }								
                }
            }
            
        }	
                    $_SESSION['status'] = "User Does Not Exist";
                    $_SESSION['status_code'] = "error";
                    header("Location:signin.php?User Does Not Exist");				
    }
    
}

function admin_login_check($con)
	{
	
		if(isset($_SESSION['id']))
		{	
			$id = $_SESSION['id'];	
			$result = mysqli_query($con, "SELECT * FROM users WHERE id='$id' AND isAdmin=1");

			if($result && mysqli_num_rows($result) > 0)
			{
				$user_data = mysqli_fetch_assoc($result);
				return $user_data;
			}
		}
	
		//redirect to login
		header("Location:signin.php");
		die;
	
	}

function get_storyteller_by_id($con){
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
    $user_id = $params['userid'];

    $result = mysqli_query($con,"SELECT * FROM users WHERE id = '$user_id'");

    return mysqli_fetch_assoc($result);
}

function active_users($con) 
    {
        $count = 0;
        $acive_users = mysqli_query($con,"SELECT * FROM users WHERE isActive = 1 AND isStoryTeller=1");
        
        while(mysqli_fetch_array($acive_users) ){
            ++$count;
        } 
        return $count;
    }

function inactive_users($con)
    {
        $count = 0;
        $inacive_users = mysqli_query($con,"SELECT * FROM users WHERE isActive = 0 AND isStoryTeller=1");
        
        while(mysqli_fetch_array($inacive_users) ){
            ++$count;
        } 
        return $count;
    }
function all_storytellers($con)
    {
        $count = 0;
        $inacive_users = mysqli_query($con,"SELECT * FROM users WHERE isStoryTeller=1");
        
        while(mysqli_fetch_array($inacive_users) ){
            ++$count;
        } 
        return $count;
    }

function admin_published_stories($con)
	{
        $count = 0;
        $published_stories = mysqli_query($con,"SELECT * FROM stories WHERE StoryStatus = 1");
        
        while(mysqli_fetch_array($published_stories) ){
            ++$count;
        } 
        return $count;
	}

    function admin_pending_stories($con)
	{

        $count = 0;
        $pending_stories = mysqli_query($con,"SELECT * FROM stories WHERE StoryStatus = 2");
            
        while(mysqli_fetch_array($pending_stories) ){
            ++$count;
        } 
        return $count;
	}

    function admin_rejected_stories($con)
	{
        $count = 0;
        $rejected_stories = mysqli_query($con,"SELECT * FROM stories WHERE StoryStatus = 3");
            
        while(mysqli_fetch_array($rejected_stories) ){
            ++$count;
        } 
        return $count;
	}

	function admin_total_stories($con)
	{
        $count = 0;
        $stories = mysqli_query($con,"SELECT * FROM stories");
            
        while(mysqli_fetch_array($stories) ){
            ++$count;
        } 
        return $count;
	}

    function all_stories($con){

		return mysqli_query($con,"SELECT * FROM stories");
	}

    function all_users($con){

		return mysqli_query($con,"SELECT * FROM users WHERE isStoryTeller=1");
	}

    function admin_published__stories($con){
        $story_teller = get_storyteller_by_id($con);

			$count = 0;
			$published_stories = mysqli_query($con,"SELECT * FROM stories WHERE StoryStatus = 1 AND userid = '$story_teller[id]'");
			
			while(mysqli_fetch_array($published_stories) ){
				++$count;
			} 
			return $count;
    }

    function admin_pending__stories($con){
        $story_teller = get_storyteller_by_id($con);

			$count = 0;
			$pending_stories = mysqli_query($con,"SELECT * FROM stories WHERE StoryStatus = 2 AND userid = '$story_teller[id]'");
			
			while(mysqli_fetch_array($pending_stories) ){
				++$count;
			} 
			return $count;
    }

    function admin_rejected__stories($con){
        $story_teller = get_storyteller_by_id($con);

			$count = 0;
			$rejected_stories = mysqli_query($con,"SELECT * FROM stories WHERE StoryStatus = 3 AND userid = '$story_teller[id]'");
			
			while(mysqli_fetch_array($rejected_stories) ){
				++$count;
			} 
			return $count;
    }

    function admin_ratings_Reviews($con)
	{
        $story_teller = get_storyteller_by_id($con);

            $count = 0;
            $reviews = mysqli_query($con,"SELECT * FROM reviews WHERE TellerId = '$story_teller[id]'");
                
            while(mysqli_fetch_array($reviews) ){
                ++$count;
            } 
            return $count;
        
	}


    function storytellertotal__stories($con){
        $story_teller = get_storyteller_by_id($con);

			$count = 0;
			$rejected_stories = mysqli_query($con,"SELECT * FROM stories WHERE userid = '$story_teller[id]'");
			
			while(mysqli_fetch_array($rejected_stories) ){
				++$count;
			} 
			return $count;
    }

    function my_reviewss($con){
            $story_teller = get_storyteller_by_id($con);
		    return mysqli_query($con,"SELECT * FROM reviews WHERE TellerId = '$story_teller[id]'");

	}


    // approve story
        if(isset($_POST['approvebtn']) )
		{
            include("connection.php");
            // include("functions.php");

            $story = $_POST['storyid'];
            mysqli_query($con,"UPDATE stories set StoryStatus='Approved' WHERE id = '$story'");
            
            $_SESSION['status'] = "Story Approved";
		    $_SESSION['status_code'] = "success";
            header("Location:./details.php?storyid=$story");      

        }


        //disapprove story
        if(isset($_POST['disapprovebtn']) )
		{
            include("connection.php");
            //include("functions.php");

            $story_id = $_POST['storyid'];
            mysqli_query($con,"UPDATE stories set StoryStatus='Rejected' WHERE id = '$story_id'");
            // //email_sender($user_data['Email'], $user_data['FirstName'], "Hi $user_data[FirstName],<br>Your story Titled $story_data[Title] has been approved.",'Story Approved');

            
            $_SESSION['status'] = "Story Disapproved";
		    $_SESSION['status_code'] = "success";         
            header("Location:./details.php?storyid=$story_id");
            

        }


        //approve user
        if(isset($_POST['activatebtn']) )
		{
            include("connection.php");
            include("functions.php");
            $user_id = $_POST['userid'];
            mysqli_query($con,"UPDATE users set isActive=1 WHERE id = '$user_id'");
            $result = mysqli_query($con,"SELECT * FROM users WHERE id = '$user_id'");
            $user_data = mysqli_fetch_assoc($result);

            //send email to user
            email_sender($user_data['Email'], $user_data['FirstName'], "Hi $user_data[FirstName],<br>Your account has been activated.",'Acount confirmed');
            $_SESSION['status'] = "User Activated";
		    $_SESSION['status_code'] = "success";
            header("Location:./Admin/users.php?userid=$user_id");   

        }

        //disapprove user
        if(isset($_POST['deactivatebtn']) )
		{
            include("connection.php");
            include("functions.php");

            $user_id = $_POST['userid'];
            mysqli_query($con,"UPDATE users set isActive=0 WHERE id = '$user_id'");
            $result = mysqli_query($con,"SELECT * FROM users WHERE id = '$user_id'");
            $user_data = mysqli_fetch_assoc($result);

            //send email to user
            email_sender($user_data['Email'], $user_data['FirstName'], "Hi $user_data[FirstName],<br>You Account has been deactivated.",'Acount Deactivated');

            $_SESSION['status'] = "User Deactivated";
		    $_SESSION['status_code'] = "success";
            header("Location:./Admin/users.php?userid=$user_id");   

        }

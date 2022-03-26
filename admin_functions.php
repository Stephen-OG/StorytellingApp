<?php
    include("connection.php");

function get_admin_by_id($con){
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
    $admin_id = $params['adminid'];

    $result = mysqli_query($con,"SELECT * FROM users WHERE id = '$admin_id'");
    
        if($result && mysqli_num_rows($result) > 0)
        {
            $user_data = mysqli_fetch_assoc($result);
            $_SESSION['id'] = $user_data['id'];
            return $user_data;
        }
        //redirect to login
		header("Location:index.php");
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

    function published__stories($con){
        $story_teller = get_storyteller_by_id($con);

			$count = 0;
			$published_stories = mysqli_query($con,"SELECT * FROM stories WHERE StoryStatus = 1 AND userid = '$story_teller[id]'");
			
			while(mysqli_fetch_array($published_stories) ){
				++$count;
			} 
			return $count;
    }

    function pending__stories($con){
        $story_teller = get_storyteller_by_id($con);

			$count = 0;
			$pending_stories = mysqli_query($con,"SELECT * FROM stories WHERE StoryStatus = 2 AND userid = '$story_teller[id]'");
			
			while(mysqli_fetch_array($pending_stories) ){
				++$count;
			} 
			return $count;
    }

    function rejected__stories($con){
        $story_teller = get_storyteller_by_id($con);

			$count = 0;
			$rejected_stories = mysqli_query($con,"SELECT * FROM stories WHERE StoryStatus = 3 AND userid = '$story_teller[id]'");
			
			while(mysqli_fetch_array($rejected_stories) ){
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

    function approve_story($con) {
        if(isset($_POST['approvebtn']) )
		{
            $story = $_POST['storyid'];
            mysqli_query($con,"UPDATE stories set StoryStatus='Approved' WHERE id = '$story'");
            echo "<script>alert('Story Approved')</script>";       

        }
    }

    function disapprove_story($con){
        if(isset($_POST['disapprovebtn']) )
		{
            $story = $_POST['storyid'];
            mysqli_query($con,"UPDATE stories set StoryStatus='Rejected' WHERE id = '$story'");
            echo "<script>alert('Story Disapproved')</script>";
            //echo "<script src'https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js'>swal('Rejected', '', 'error')</script>";
        }
    }

    function activate_user($con) {
        if(isset($_POST['activatebtn']) )
		{
            $user = $_POST['userid'];
            mysqli_query($con,"UPDATE users set isActive=1 WHERE id = '$user'");
            echo "<script>alert('User Activated')</script>";       

        }
    }

    function deactivate_user($con) {
        if(isset($_POST['deactivatebtn']) )
		{
            $user = $_POST['userid'];
            mysqli_query($con,"UPDATE users set isActive=0 WHERE id = '$user'");
            echo "<script>alert('User Deactivated')</script>";       

        }
    }
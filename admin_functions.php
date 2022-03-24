<?php

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

		return mysqli_query($con,"SELECT * FROM users");
	}
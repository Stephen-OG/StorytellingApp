<?php

	function published_stories($con)
	{
		if(isset($_SESSION['id']))
			{
				$id = $_SESSION['id'];

			$count = 0;
			$published_stories = mysqli_query($con,"SELECT * FROM stories WHERE StoryStatus = 1 AND userid = '$id'");
			
			while(mysqli_fetch_array($published_stories) ){
				++$count;
			} 
			return $count;
		}
	}

    function pending_stories($con)
	{
		if(isset($_SESSION['id']))
			{
				$id = $_SESSION['id'];

				$count = 0;
				$pending_stories = mysqli_query($con,"SELECT * FROM stories WHERE StoryStatus = 2 AND userid = '$id'");
					
				while(mysqli_fetch_array($pending_stories) ){
					++$count;
				} 
				return $count;
			}
	}

    function rejected_stories($con)
	{
		if(isset($_SESSION['id']))
			{
				$id = $_SESSION['id'];

				$count = 0;
				$rejected_stories = mysqli_query($con,"SELECT * FROM stories WHERE StoryStatus = 3 AND userid = '$id'");
					
				while(mysqli_fetch_array($rejected_stories) ){
					++$count;
				} 
				return $count;
			}
	}

	function total_stories($con)
	{
		if(isset($_SESSION['id']))
			{
				$id = $_SESSION['id'];
				$count = 0;
				$stories = mysqli_query($con,"SELECT * FROM stories WHERE userid = '$id'");
					
				while(mysqli_fetch_array($stories) ){
					++$count;
				} 
				return $count;
			}
	}

	function my_stories($con){
		if(isset($_SESSION['id']))
			{
				$id = $_SESSION['id'];
				return mysqli_query($con,"SELECT * FROM stories WHERE userid = '$id'");
			}
	}

	function get_story_by_id($con){
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
		$story_id = $params['storyid'];

		$result = mysqli_query($con,"SELECT * FROM stories WHERE id = '$story_id'");

		return mysqli_fetch_assoc($result);
	}

	//edit story 
		if(isset($_POST['editStory']))
		{
			// I called the get_story_by_id function to edit a story
			include("connection.php");
			$result = get_story_by_id($con);
			$story_id = $result['id'];
			$title = $_POST['title'];
			$filename = uploadFile();
			$body = $_POST['body'];
			if(!uploadFile()){
				$filename = $_POST['imagename'];
			}
			mysqli_query($con,"UPDATE stories set Title='$title', Body='$body', ImageName='$filename' WHERE id = '$story_id'");				
			$_SESSION['status'] = "Story Updated";
		    $_SESSION['status_code'] = "success";

			header("Location:StoryTeller/index.php");
			die;
		}
	
    if(isset($_POST['deletestory'])){
			{
				include("connection.php");

				$storyid = $_POST['storyid'];
	
				mysqli_query($con,"DELETE FROM stories WHERE id = '$storyid' ");
				$_SESSION['status'] = "Deleted Successfully";
		    	$_SESSION['status_code'] = "success";
            	
				header("Location:StoryTeller/index.php"); 

			}
		}

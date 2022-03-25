<?php

 if(isset($_POST['story_id']) && $_POST['story_id'] && isset($_POST['user_id']) && $_POST['user_id']){
    echo "<script>alert('i entered yosi's php file')</script>"; 
    
    $sid = $_POST['story_id'];
    $uid = $_POST['user_id'];


    if(empty($sid) && empty($uid))
        {
            echo json_encode(array('success' => 3));
            
        }

        $result = mysqli_query(mysqli_connect("localhost","root","","storytellingdb"), "SELECT * FROM user_saved_stories WHERE StoryId='$sid' ");
        if (mysqli_num_rows($result) > 0 ){

            echo json_encode(array('success' => 2));

        }
        else 
        {
            mysqli_query(mysqli_connect("localhost","root","","storytellingdb"), "INSERT INTO user_saved_stories (UserId,StoryId) VALUES ('$uid','$sid')");
            
            echo json_encode(array('success' => 1));

        }
    
}
?>
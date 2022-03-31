<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require 'PHPMailer-master/src/Exception.php';
	require 'PHPMailer-master/src/PHPMailer.php';
	require 'PHPMailer-master/src/SMTP.php';

	//signup function
		if(isset($_POST['btnSubmitForm'])){
			include("connection.php");

			$first_name = $_POST['firstname'];
			$last_name = $_POST['lastname'];
			$email = $_POST['email'];
			$password = $_POST['password'];
			$confirmPassword = $_POST['confirmPassword'];
			$isStoryTeller = $_POST['isStoryTeller'];
			$isStorySeeker = $_POST['isStorySeeker'];
			$isAdmin = $_POST['isAdmin'];
			$isActive = $_POST['isActive'];

			if( $password != $confirmPassword){
				$_SESSION['status'] = "Password Do Not Match";
				$_SESSION['status_code'] = "error";
				header("Location:signup.php?error=password do not match");

				die;
			}else{

				$hashed_password = password_hash($password, PASSWORD_DEFAULT);			

				$result = mysqli_query($con, "SELECT * FROM users WHERE Email='$email' ");

				$user_data = mysqli_fetch_assoc($result);

				//check if the email has been used before
				if (mysqli_num_rows($result) > 0 )  {
						$_SESSION['status'] = "User Exist";
						$_SESSION['status_code'] = "error";
						header("Location:signup.php?error=The email already exists, please try another");
						die;
					}


					else {

					//save to database					
					$query = "insert into users (
						Email,
						FirstName,
						LastName,
						Password,
						isStoryTeller,
						isStoryseeker,
						isAdmin,
						isActive) values 
					(
					'$email',
					'$first_name',
					'$last_name',
					'$hashed_password',
					'$isStoryTeller',
					'$isStorySeeker',
					'$isAdmin',
					'$isActive')";	
					
					//check if email is valid
					if(mysqli_query($con,$query))
					{
						email_sender($email, $first_name, "Hi, $first_name <br>You have just signed up on the Story Telling app.",'Signup confirmed');
						$_SESSION['status'] = "Registered Successfully";
						$_SESSION['status_code'] = "success";
						header("Location:signin.php");
						die;
					}else{
						$_SESSION['status'] = "Data not registered ";
						$_SESSION['status_code'] = "warning";
						header("Location:signup.php");
						}					
					}	
			}				
		}


	//login in function
	if(isset($_POST['loginbtn'])){
		{
			include("connection.php");

		//something was posted
		$email = $_POST['email'];
		$password = $_POST['password'];

		if(empty($email) && empty($password))
		{
			echo "<script>alert('There are no fields to generate a report')</script>"; 
		}

			//read from database
			$result = mysqli_query($con, "SELECT * FROM users WHERE Email='$email' LIMIT 1");

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{
					$user_data = mysqli_fetch_assoc($result);
					
					if(!password_verify($password, $user_data['Password']))
					{
						$_SESSION['status'] = "Password Do Not Match";
						$_SESSION['status_code'] = "warning";
						header("Location:signin.php?error=password do not match");
						die;

					}
					else{
						//save cookie
						if(isset($_POST['remember']))
						{
							setcookie('email',$email, time()+30*24*60*60);
							setcookie('password',$password, time()+30*24*60*60);
						} else{
							setcookie('email','');
							setcookie('password','');
						}

						$_SESSION['id'] = $user_data['id'];							

						if($user_data['isStoryTeller'] == 1 && $user_data['isStorySeeker']== 1){
							email_sender($user_data['Email'], $user_data['FirstName'], "Hi, $user_data[FirstName], <br>You have just signed in on the Story Telling app.","Signin confirmed");
							//echo $response;
							$_SESSION['status'] = "Logged In ";
							$_SESSION['status_code'] = "success";
							header("Location:StoryTeller/index.php");
							die;
						}
						elseif($user_data['isStoryTeller']== 0 && $user_data['isStorySeeker'] == 1){
							email_sender($user_data['Email'], $user_data['FirstName'], "Hi, $user_data[FirstName], <br>You have just signed in on the Story Telling app.","Signin confirmed");
							//echo $response;
							$_SESSION['status'] = "Logged In";
							$_SESSION['status_code'] = "success";
							header("Location:StorySeeker/index.php");
							die;
						}
						else{
						$_SESSION['status'] = "User Does Not Exist";
						$_SESSION['status_code'] = "warning";
						header("Location:signin.php?User Does Not Exist");	
						}								
					}
				}
				
			}	
						$_SESSION['status'] = "User Does Not Exist";
						$_SESSION['status_code'] = "warning";
						header("Location:signin.php?User Does Not Exist");				
		}
		
	}


	
	function user_login_check($con)
	{
	
		if(isset($_SESSION['id']))
		{	
			$id = $_SESSION['id'];	
			$result = mysqli_query($con, "SELECT * FROM users WHERE id='$id' LIMIT 1");

			if($result && mysqli_num_rows($result) > 0)
			{
				$user_data = mysqli_fetch_assoc($result);
				return $user_data;
			}
		}
	
		//redirect to login
		header("Location:../signin.php");
		die;
	
	}

	// Update User Profile
		if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['updateProfile']))
		{
			include("connection.php");

			if(isset($_SESSION['id']))
			{
				$id = $_SESSION['id'];
				$first_name = $_POST['firstname'];
				$last_name = $_POST['lastname'];
				$filename = uploadFile();
				
				if(!uploadFile()){
					$filename = $_POST['imagename'];
				}
				$result = mysqli_query($con,"UPDATE users set FirstName='$first_name', LastName='$last_name', ProfileImage='$filename' WHERE id = '$id'");
				if($result){
					$id = $_SESSION['id'];	
					$user = mysqli_query($con, "SELECT * FROM users WHERE id='$id' LIMIT 1");
					$user_data = mysqli_fetch_assoc($user);

					$_SESSION['status'] = "Profile Updated ";
					$_SESSION['status_code'] = "success";
					if($user_data['isStorySeeker'] == 1 && $user_data['isStoryTeller'] == 0)
					{
						header("Location:StorySeeker/index.php");
					}
					elseif($user_data['isStorySeeker'] == 1 && $user_data['isStoryTeller'] == 1){ 
						$_SESSION['status'] = "Profile Updated ";
						$_SESSION['status_code'] = "success";
						header("Location:StoryTeller/index.php");
					}
				}				
				
			}

		}

	
		//add story as a teller

		if(isset($_POST['addStory']))
		{
			include("connection.php");


		$title = $_POST['title'];

		$Location =$_POST['location'];

		//called upload function for story image
		$filename = uploadFile();

		$Category = strtolower($_POST['category']);
		

		$Body = $_POST['body'];

		if(isset($_SESSION['id']))
			{
				$user_id = $_SESSION['id'];
				$query = "insert into stories (userid, Title, Location, Category, Body, ImageName, StoryStatus) values 
												('$user_id','$title', '$Location','$Category','$Body','$filename','Pending')";

				$result = mysqli_query($con,$query);
				if ($result){
					$_SESSION['status'] = "Story Added Successfully";
					$_SESSION['status_code'] = "success";
					header("Location:StoryTeller/index.php");
				 	die;
				}
				else{
					$_SESSION['status'] = "Story not added";
		    		$_SESSION['status_code'] = "warning";
					header("Location:StoryTeller/index.php");
					die;
					}				
			}				
			else{
				echo "user logged out";
				die;
			}
		}


	//image upload function 
	function uploadFile(){
		// Check if the form was submitted
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			// Check if file was uploaded without errors
			if(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == 0){
				$allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png", "");
				$filename = $_FILES["photo"]["name"];
				$filetype = $_FILES["photo"]["type"];
				$filesize = $_FILES["photo"]["size"];
			
				// Verify file extension
				$ext = pathinfo($filename, PATHINFO_EXTENSION);
				if(!array_key_exists($ext, $allowed)) die("Error: Please select a valid file format.");
			
				// Verify file size - 3MB maximum
				$maxsize = 3 * 1024 * 1024;
				if($filesize > $maxsize) die("Error: File size is larger than the allowed limit.");
			
				// Verify MYME type of the file
				if(in_array($filetype, $allowed)){
					// Check whether file exists before uploading it
					if(file_exists("uploads/" . $filename)){
						echo $filename . " is already exists.";
					} else{
						move_uploaded_file($_FILES["photo"]["tmp_name"], "uploads/" . $filename);
						echo "Your file was uploaded successfully.";
						
					} 
				} else{
					echo "Error: There was a problem uploading your file. Please try again."; 
				}
				
			} else{
				echo "Error: " . $_FILES["photo"]["error"];
				return "";
			}
		}
		return $filename;
	}

	//change user password
		if(isset($_POST['changePassword'])){
			include("connection.php");
		$current_password = $_POST['currentpassword'];
		$password = $_POST['password'];
		$confirm_password = $_POST['confirmpassword'];
	
			if(isset($_SESSION['id']))
			{
				$user_id = $_SESSION['id'];
				$query = "select * from users where id = '$user_id' limit 1";
				$result = mysqli_query($con, "SELECT * FROM users WHERE id='$user_id' LIMIT 1");

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);

					if( $password != $confirm_password){
						$_SESSION['status'] = "confirm password does not match the password";
						$_SESSION['status_code'] = "error";
						if($user_data['isStorySeeker'] == 1 && $user_data['isStoryTeller'] == 0){
							header("Location:StorySeeker/index.php");
							}
							else{
								header("Location:StoryTeller/index.php");
							}
					}else{

					if(!password_verify($current_password, $user_data['Password'])){
						$_SESSION['status'] = "Incorrect Password";
						$_SESSION['status_code'] = "warning";
						if($user_data['isStorySeeker'] == 1 && $user_data['isStoryTeller'] == 0){
							header("Location:StorySeeker/index.php");
							}
							else{
								header("Location:StoryTeller/index.php");
							}
					}else{
						$hashed_password = password_hash($confirm_password, PASSWORD_DEFAULT);
						mysqli_query($con, "UPDATE users set Password='$hashed_password' WHERE id = '$user_id'" );
						$_SESSION['status'] = "Password Changed";
						$_SESSION['status_code'] = "success";
						if($user_data['isStorySeeker'] == 1 && $user_data['isStoryTeller'] == 0){
						header("Location:StorySeeker/index.php");
						}
						else{
							header("Location:StoryTeller/index.php");
						}
					}
				}
			}

		}
	}
	}


	//function used for sending mail out
	function email_sender($toMailAddress, $toName, $body, $subject)
	{
			//Instantiation and passing `true` enables exceptions
			$mail = new PHPMailer(true);

				try {
						//Server settings
						$mail->SMTPDebug = 0;                      //Enable verbose debug output
						$mail->isSMTP();                                            //Send using SMTP
						$mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
						$mail->SMTPAuth   = true;                                   //Enable SMTP authentication
						$mail->Username   = 'storyteller.globe@gmail.com';                     //SMTP username
						$mail->Password   = 'Storyteller2003';                               //SMTP password
						$mail->SMTPSecure = 'tls';         		//Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
						$mail->Port       = 587;   
						$mail->SMTPOptions = array(
							'ssl' => array(
							'verify_peer' => false,
							'verify_peer_name' => false,
							'allow_self_signed' => true
							)
							);                                 //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

						//Recipients
						$mail->setFrom('storyteller.globe@gmail.com', 'Story Telling App - Joey Zaza');
						$mail->addAddress($toMailAddress, $toName);     //Add a recipient

						//Content
						$mail->isHTML(true);                                  //Set email format to HTML
						$mail->Subject = $subject;
						$mail->Body    = $body;
						$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

						$mail->send();
						echo 'Message has been sent';
						} catch (Exception $e) {
						echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
					} 	
	}

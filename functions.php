<?php
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;

	require $_SERVER['DOCUMENT_ROOT'].'PHPMailer-master/src/Exception.php';
	require $_SERVER['DOCUMENT_ROOT'].'PHPMailer-master/src/PHPMailer.php';
	require $_SERVER['DOCUMENT_ROOT'].'PHPMailer-master/src/SMTP.php';

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
				echo 'password do not match';
				die;
			}else{

				$hashed_password = password_hash($password, PASSWORD_DEFAULT);			

			// if ($first_name == "" || $last_name == "" || $email == "" || $hashed_password == "" ) {
			// 	$msg = "<script>alert('There are no fields to generate a report')</Script>";
			// 	  return $msg;
			// }

			// if(empty($email) && empty($password) )
			// {
			// 	echo "<script>alert('There are no fields to generate a report');</script>"; 
			// }

				$result = mysqli_query($con, "SELECT * FROM users WHERE Email='$email' ");

				$user_data = mysqli_fetch_assoc($result);

				//check if the email has been used before
				if (mysqli_num_rows($result) > 0 && $user_data['isStoryseeker'] == 1)  {
						header("Location:signup.php?error=The email already exists, please try another");
						exit();
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

					if(mysqli_query($con,$query))
					{
						email_sender($email, $first_name, 'Hi,<br>You have just signed up on the Story Telling app.','Signup confirmed');
						$_SESSION['status'] = "Registered Successfully";
						$_SESSION['status_code'] = "success";
						header("Location:signin.php");
						die;
					}
					else{
						$_SESSION['status'] = "Data Not Registered";
						$_SESSION['status_code'] = "error";
						//echo "<script>alert('failed to add')</script>";
					}	

			}
			}				
		}


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
						echo 'password do not match';
					}
					else{
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
							//email_sender($email, $first_name, 'Hi,<br>You have just signed in on the Story Telling app.','Signin confirmed');
							$_SESSION['status'] = "Logged In ";
							$_SESSION['status_code'] = "success";
							header("Location:StoryTeller/index.php");
							die;
						}
						elseif($user_data['isStoryTeller']== 0 && $user_data['isStorySeeker'] == 1){
							//email_sender($email, $first_name, 'Hi,<br>You have just signed up on the Story Telling app.','Signin confirmed');
							$_SESSION['status'] = "Loggen In";
							$_SESSION['status_code'] = "success";
							header("Location:StorySeeker/index.php");
							die;
						}else{
						$_SESSION['status'] = "User Does Not Exist";
						$_SESSION['status_code'] = "error";
						header("Location:signin.php?User Does Not Exist");	
						}								
					}
				}
				
			}	
						$_SESSION['status'] = "User Does Not Exist";
						$_SESSION['status_code'] = "error";
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
				mysqli_query($con,"UPDATE users set FirstName='$first_name', LastName='$last_name', ProfileImage='$filename' WHERE id = '$id'");				
				$_SESSION['status'] = "Profile Updated ";
				$_SESSION['status_code'] = "success";
				if($user_data['isStorySeeker'] == 1 && $user_data['isStoryTeller'] == 0){
					header("Location:StorySeeker/index.php");
					}
					else{
						header("Location:StoryTeller/index.php");
					}
			}

		}

	
		//add story

		if(isset($_POST['addStory']))
		{
			include("connection.php");


		$title = $_POST['title'];

		$Location =$_POST['location'];

		$filename = uploadFile();

		$Category = strtolower($_POST['category']);
		

		$Body = $_POST['body'];

		if(isset($_SESSION['id']))
			{
				$user_id = $_SESSION['id'];
				$query = "insert into stories (userid, Title, Location, Category, Body, ImageName) values 
												('$user_id','$title', '$Location','$Category','$Body','$filename')";

				$result = mysqli_query($con,$query);
				if ($result){
					$_SESSION['status'] = "Story Added Successfully";
					$_SESSION['status_code'] = "success";
					header("Location:StoryTeller/index.php");
				 	die;
				}
				else{
					$_SESSION['status'] = "Story not added";
		    		$_SESSION['status_code'] = "error";
					header("Location:StoryTeller/index.php");
					die;
					}				
			}				
			else{
				echo "user logged out";
				die;
			}
		}


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
			
				// Verify file size - 5MB maximum
				$maxsize = 5 * 1024 * 1024;
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
						$_SESSION['status_code'] = "error";
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
						$mail->Username   = 'oladipupojuwon99@gmail.com';                     //SMTP username
						$mail->Password   = 'Systems@10';                               //SMTP password
						$mail->SMTPSecure = 'tls';         		//Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
						$mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

						//Recipients
						$mail->setFrom('ogunderostephen@gmail.com', 'Story Telling App - Joey Zaza');
						$mail->addAddress($toMailAddress, $toName);     //Add a recipient

						//Content
						$mail->isHTML(true);                                  //Set email format to HTML
						$mail->Subject = $subject;
						$mail->Body    = $body;
						$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

						$mail->send();
						//echo 'Message has been sent';
						} catch (Exception $e) {
						//echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
					} 	
	}

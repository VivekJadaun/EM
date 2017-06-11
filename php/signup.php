<!doctype html>
<html>
<head></head>
<body>
	<?php 
	$db = mysqli_connect('localhost','vivek','alohamora','expensemanager');
	if (!$db) {
		die("Connection failed: " . mysqli_connect_error());
	}
	echo "Connected successfully.<br>";
	$user = $_POST['user'];
	$password = $_POST['pwd'];
	$retypepwd = $_POST['cpwd'];
	$secret=$_POST['6LebBSUUAAAAAGWtsp-AC4F-cn3XYPj2gxCWJPq_'];
	$response=$_POST['g-recaptcha-response'];
	https://www.google.com/recaptcha/api/siteverify
	POST /siteverify HTTP/1.1
	if($password == $retypepwd){
		$query = "SELECT * FROM userdata WHERE user_id='$user' LIMIT 1";
		$result=mysqli_query($db,$query);

		if (mysqli_num_rows($result) > 0){
			echo "That username is taken. Please choose another one";
		}
		else{
			$query = "INSERT INTO userdata (user_id,password) VALUES ('$user','$password')";
			if(mysqli_query($db,$query)){
				echo "Congratulations ".$user."! You are now registered with us";	
			}
			else{
				echo "Sorry! Unable to insert into the database.<br>".mysqli_error($db);
			}
		}
	}
	else{
		echo "Passwords don't match! Retype password";
	}
	mysqli_close($db);
	?>
</body>
</html>

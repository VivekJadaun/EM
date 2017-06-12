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
	$remoteip=$_SERVER['REMOTE_ADDR'];
	$verify=http_build_query($secret,$response,$remoteip);
	$contextData=array(
		'method' => 'POST',
		'header' => "Connection: close\r\n".
			    "Content-Length: ".strlen($verify)."\r\n",
		'content'=> $verify);
	$context= stream_context_create(array ( 'http' => $contextData));
	$answer= file_get_contents (
		'https://www.google.com/recaptcha/api/siteverify',
		false,
		$context);
	$array= json_decode($answer,true);
	if ($array['success']=="true")
		echo "congratulations! u are a human";
	else 
		echo "BOOO HOOO";
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

<!doctype html>
<html>
<head></head>
<body>
	<?php 
	$db = mysqli_connect('localhost','root','NULL','expensemanager');
	if (!$db) {
		die("Connection failed: " . mysqli_connect_error());
	}
	echo "Connected successfully.<br>";
	$user = $_POST['user'];
	$password = $_POST['pwd'];
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
	mysqli_close($db);
	?>
</body>
</html>
<?php 
$db = new mysqli('127.0.0.1','vivek','alohamora','expensemanager') ;
$user = $_POST['user'];
$passwd = $_POST['pwd'];
$query = "SELECT * FROM userdata WHERE user_id='$user' AND password='$passwd'" ;
$result=mysqli_query($db,$query);
if (mysqli_num_rows($result) > 0){ 
	echo "<script type='text/javascript'>window.location.href='../html/expenses.html'</script>";
}else{
	echo "<script type='text/javascript'> alert('Invalid username or password'); document.location =  '../html/form.html' </script>" ;
	die ('Error querying the database');
}
$db->close();
?>
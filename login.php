<?php 
include("config/db.php");
include("admin/inc/functions.php");
session_start();

	if (isset($_POST['Login'])) {

	$username = mysqli_real_escape_string($connect, $_POST['username']);
	$password = mysqli_real_escape_string($connect, $_POST['password']);

	$query = mysqli_query($connect, "SELECT * FROM users WHERE username = '$username' ");
	confirmQuery($query);	

	while ($row = mysqli_fetch_assoc($query)) {
	  $db_id = $row['user_id'];
	  $db_username = $row['username'];
	  $db_password = $row['user_password'];
	  $db_firstname = $row['user_firstname'];
	  $db_lastname = $row['user_lastname'];
	  $db_user_role = $row['user_role'];
	}

	$password = crypt($password, $db_password);

	if ($username == $db_username && $password == $db_password) {
		$_SESSION['username'] =		$db_username; 	 
		$_SESSION['firstname'] =	$db_firstname; 	
		$_SESSION['lastname'] =		$db_lastname; 	 
		$_SESSION['user_role'] =	$db_user_role; 	
		header("Location: admin");
	}else {	
		header("Location: index.php");	
	}
}

 ?>
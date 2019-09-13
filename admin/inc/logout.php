<?php 
session_start();
session_destroy();
header("Location: ../index.php");


// $_SESSION['username'] =	 null;
// $_SESSION['firstname'] = null;
// $_SESSION['lastname'] =	 null;
// $_SESSION['user_role'] = null;


 ?>
<?php 

	function users_online(){

		if (isset($_GET['OnlineUsers'])) {

		global $connect;
		if (!$connect) {
			session_start();
			include("../../config/db.php");

			$session = session_id();
            $time = time();
            $time_out_in_seconds = 60;
            $time_out = $time - $time_out_in_seconds;

            $query = mysqli_query($connect, "SELECT * FROM users_online WHERE session = '$session'");
            $count = mysqli_num_rows($query);

            if ($count == NULL) {
                mysqli_query($connect, "INSERT INTO users_online(`session`, `time`) VALUES('$session', '$time') ");
            }else {
                mysqli_query($connect, "UPDATE users_online SET `time` = '$time' WHERE session = '$session' ");
            }

            $users_online_query =  mysqli_query($connect, "SELECT * FROM users_online WHERE `time` > '$time_out' ");
            echo  $count_user = mysqli_num_rows($users_online_query);

		}

        } //GET request isset
	}
	users_online();

	function confirmQuery($query){
		global $connect;
		if (!$query) {
            die("AN ERROR OCCURED" . mysqli_error($connect));
        }
	}
	
	function navCategories(){
		global $connect;
		$query = mysqli_query($connect, "SELECT * FROM categories");
	    while ($row = mysqli_fetch_assoc($query)) {
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "
				<li>
					<a href='#'> $cat_title </a>
					
				</li>";
			}   
	}

	function add_categories(){
		global $connect;
	 if (isset($_POST['add_cat'])) {
        $cat_title = $_POST['cat_title'];
        if ($cat_title == "" || empty($cat_title)) {
            echo 'This field is required';
        }else {
             $add_cat_query = mysqli_query($connect, "INSERT INTO categories (cat_title) VALUES ('$cat_title')");
            if ($add_cat_query) {
                echo "<script>alert(\"added\")</script>";
            }
        }
    }

}

	function delete_categories(){
		global $connect;
		 if (isset($_GET['delete-cat']) && !empty($_GET['delete-cat'])) {
	        $del_cat = $_GET['delete-cat'];
	        $delete_cat_query =  mysqli_query($connect, "DELETE FROM categories WHERE cat_id = $del_cat ");
	        if ($delete_cat_query) {
	            header("Location: categories.php");
	        }
	    } 
	}

            
 ?>
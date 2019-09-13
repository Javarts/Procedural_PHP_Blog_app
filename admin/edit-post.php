<div class="col-md-8">

	<?php 

		$title = "EDIT POST";

		if (isset($_GET['p_id'])) {
			$key_p_id = $_GET['p_id'];
		}

		$Select_Posts_id = mysqli_query($connect, "SELECT * FROM posts WHERE post_id = $key_p_id");
        while ($row = mysqli_fetch_assoc($Select_Posts_id)) {
        $post_id = $row['post_id'];
        $post_cat_id = $row['post_category_id'];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_date = $row['post_date'];
        $post_image = $row['post_image'];
        $post_comment = $row['post_comment_count'];
        $post_content = $row['post_content'];
        $post_tags = $row['post_tags'];
        $post_status = $row['post_status'];
	}

		if (isset($_POST['Update_post'])) {
			$post_author = $_POST['author'];
			$post_title = $_POST['title'];
			$post_cat = $_POST['post_cat'];
			$post_status = $_POST['status'];
			$post_image = $_FILES['image']['name'];
			$post_image_temp = $_FILES['image']['tmp_name'];
			$post_content = $_POST['content'];  
			$post_tags = $_POST['tags'];
			// $post_date = date('d-m-y');
			// $post_comment_count = 5;
			move_uploaded_file($post_image_temp, "uploads/$post_image");

			if (empty($post_image)) {
				$imgquery = mysqli_query($connect, "SELECT post_image FROM posts WHERE post_id = $key_p_id");
				while ($row = mysqli_fetch_assoc($imgquery)) {
				    $post_image = $row['post_image'];
				}
			}

			$update_post_query = mysqli_query($connect, "UPDATE posts SET post_category_id = '$post_cat', post_title = '$post_title', post_author = '$post_author', post_date = now(), post_image =  '$post_image', post_content = '$post_content', post_tags =  '$post_tags', post_status = '$post_status' WHERE post_id = $key_p_id ");
				confirmQuery($update_post_query);
			if ($update_post_query) {
				echo "<div class=\"alert alert-success\">Post Updated Successfully  <a href=\"../post.php?slug=$key_p_id\">View Post</a> &nbsp;&nbsp; <a href=\"posts.php\">Edit More posts</a></div>";
			}else {
				echo '<div class="alert alert-danger">Failed: An Error Occured</div>';
			}

		}
	 ?>

	<form action="" method="POST" enctype="multipart/form-data">
		
		<div class="form-group">
			<label for="title">Post Title</label>
			<input type="text" class="form-control" name="title" value="<?php echo $post_title ?>">
		</div>

		<div class="form-group">
			<label for="post_category">Select Category</label><br>
			<select name="post_cat" id="">
				<?php 
					$Get_categories = mysqli_query($connect, "SELECT * FROM categories");
					confirmQuery($Get_categories);
					while ($row = mysqli_fetch_assoc($Get_categories)) {
					    $get_cat_id = $row['cat_id'];
					    $get_cat_title = $row['cat_title'];

					    echo "<option value='$get_cat_id'>$get_cat_title</option>";
					}
				 ?>
			</select>
		</div>

		<div class="form-group">
			<label for="author">Post Author</label>
			<input type="text" class="form-control" name="author" value="<?php echo $post_author ?>">
		</div>
		
		<div class="form-group">
			<select name="status">
				<option value="<?php echo $post_status ?>"><?php echo $post_status ?></option>
				
				<?php 
					if ($post_status == 'published') {
						echo "<option value='draft'>Draft</option>";
					}else {
						echo "<option value='published'>Publish</option>";
					}
				 ?>

			</select>
		</div>
		

		<div class="form-group">
			<img src="uploads/<?php echo $post_image ?>" alt="" width="100">
		</div>

		<div class="form-group">
			<label for="image">Post image</label>
			<input type="file" class="form-control" name="image" value="<?php echo $post_image ?>">
		</div>

		<div class="form-group">
			<label for="tags">Post Tags</label>
			<input type="text" class="form-control" name="tags" value="<?php echo $post_tags ?>">
		</div>

		<div class="form-group">
			<label for="content">Post Content</label>
			<textarea name="content" id="" cols="30" rows="10" class="form-control"> <?php echo $post_content; ?> </textarea>
		</div>

		<div class="form-group">
			<button class="btn btn-primary" name="Update_post">Publish Post</button>
		</div>

	</form>
</div>
<?php $title = "ADD POST"; ?>
<div class="col-md-8">

	<?php 
		if (isset($_POST['publish_post'])) {
			$post_title = $_POST['title'];
			$post_category_id = $_POST['post_category'];
			$post_author = $_POST['author'];
			$post_status = $_POST['status'];
			// image

			$post_image = $_FILES['image']['name'];
			
			$post_image_temp = $_FILES['image']['tmp_name'];

			$post_tags = $_POST['tags'];
			$post_content = $_POST['content'];  
			$post_date = date('d-m-y');

			move_uploaded_file($post_image_temp, "uploads/$post_image");

			if (empty($post_title) || empty($post_author) || empty($post_status) || empty($post_image) || empty($post_tags) || empty($post_content)) {
				echo "	<script>alert('please fill in all fields')</script>";
			}else {
				$insert_post_query = mysqli_query($connect, "INSERT INTO posts VALUES (null, '$post_category_id', '$post_title', '$post_author', now(), '$post_image', '$post_content', '$post_tags', 0, '$post_status' )");
				confirmQuery($insert_post_query);	
				if ($insert_post_query) {
				echo "<div class=\"alert alert-success\"><b>Post Added Successfully</b>  &nbsp; <a href=\"posts.php\" ><span class=\"fa fa-eye\"></span> View All Post</a> </div>";
				}else {
					echo '<div class="alert alert-danger">Failed: An Error Occured</div>';
				}
			}
		}
	 ?>


	<form action="" method="POST" enctype="multipart/form-data">
		
		<div class="form-group">
			<label for="title">Post Title</label>
			<input type="text" class="form-control" name="title">
		</div>

		<div class="form-group">
			<label for="post_category">Select Category</label><br>
			<select name="post_category" id="">
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
			<input type="text" class="form-control" name="author">
		</div>

		<div class="form-group">
			<label for="status">Post Status</label><br>
			<select name="status" id="">
				<option value="draft" selected="" disabled="">Select Options</option>
				<option value="published">Publish</option>
				<option value="draft">Draft</option>
			</select>
		</div>

		<div class="form-group">
			<label for="image">Post image</label>
			<input type="file" class="form-control" name="image">
		</div>

		<div class="form-group">
			<label for="tags">Post Tags</label>
			<input type="text" class="form-control" name="tags">
		</div>

		<div class="form-group">
			<label for="content">Post Content</label>
			<textarea name="content" id="" cols="30" rows="10" class="form-control"></textarea>
		</div>

		<div class="form-group">
			<button class="btn btn-primary" name="publish_post">Publish Post</button>
		</div>

	</form>
</div>
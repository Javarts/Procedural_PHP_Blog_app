<?php 
include("inc/header.php"); 
		$post_widget_count = 23;

		$categories_widget_count = 543;

		$users_widget_count = 283;

		$commets_widget_count = 73;

		
		$element_text = ['Active Posts', 'Categories', 'Users', 'Comments'];

        $element_count = [$post_widget_count, $categories_widget_count, $users_widget_count, $commets_widget_count];


        // var_dump($element_text, $element_count);



 ?>

 

 <div class="container">
	<table class="table table-bordered">
		<tr>
			<?php 

				for($i = 0; $i < 4; $i++ ){
					
	                // echo "['{$element_text[$i]}'" . "," . "{$element_count [$i]} ],";
	                // echo '&nbsp;';echo '&nbsp;';echo '&nbsp;';echo '&nbsp;';echo '&nbsp;';echo '&nbsp;';echo '&nbsp;';echo '&nbsp;';
	                ?>

				<th><?php echo "$element_text[$i]"; ?></th>
		<?php }	 ?>
		</tr>

		<tbody>
			<tr>
				<?php 

				for($i = 0; $i < 4; $i++ ){
	            	// echo '&nbsp;';
	             //    echo "['{$element_text[$i]}'" . "," . "{$element_count [$i]} ],";

	                echo '&nbsp;';echo '&nbsp;';echo '&nbsp;';echo '&nbsp;';echo '&nbsp;';echo '&nbsp;';echo '&nbsp;';echo '&nbsp;';
	                ?>

				<td><?php echo $element_count[$i]; ?></td>
			<?php }	 ?>
			</tr>
		</tbody>
	</table>
 </div>
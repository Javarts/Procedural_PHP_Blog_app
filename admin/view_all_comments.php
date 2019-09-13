<table class="table table-bordered table-responsive">
    <thead>
        <tr>
            <th>ID</th>
            <th>Author</th>
            <th>Comments</th>
            <th>Email</th>
            <th>Status</th>
            <th>In Response to</th>
            <th>Date</th>
            <!-- <th>Approved</th> -->
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        
        <?php
        $get_allComments = mysqli_query($connect, "SELECT * FROM comments");
        $num = 1;
        while ($row = mysqli_fetch_assoc($get_allComments)) {
        $comment_id = $row['comment_id'];
        $comment_post_id = $row['comment_post_id'];
        $comment_author = $row['comment_author'];
        $comment_email = $row['comment_email'];
        $comment_content = $row['comment_content'];
        $comment_status = $row['comment_status'];
        $comment_date = $row['comment_date'];
        ?>
        <tr> 
            <td><?php echo $num++; ?></td>
            <td><?php echo $comment_author; ?></td>
            <td><?php echo $comment_content; ?></td>
            <td><?php echo $comment_email; ?></td>
            <td><?php echo $comment_status; ?></td>
            <?php 
                $getPosts = mysqli_query($connect, "SELECT * FROM posts WHERE post_id = $comment_post_id ");
                while ($row = mysqli_fetch_assoc($getPosts)) {
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    ?>
                    <td><a href="../post.php?slug=<?php echo $post_id ?>"><?php echo $post_title ; ?></a></td>
            <?php } ?>
            <td><?php echo $comment_date; ?></td>
            <td width="100">
                <a href="comments.php?approve=<?php echo $comment_id ?>" class="btn btn-success btn-xs" title="approve comment"><span class="fa fa-thumbs-up"></span></a>

                <a href="comments.php?unapprove=<?php echo $comment_id ?>" class="btn btn-warning btn-xs" title="unapprove comment"><span class="fa fa-thumbs-down"></span></a>

                <a href="comments.php?delete_comment=<?php echo $comment_id  ?>" class="btn btn-danger btn-xs"><span class="fa fa-trash-o"></span></a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<?php
        
     // UNAPPROVE COMMENT
     if (isset($_GET['unapprove'])) {
         $unapprove_comment = $_GET['unapprove'];

        $Unapprove_comment_query = mysqli_query($connect, "UPDATE comments SET comment_status = \"unapproved\" WHERE comment_id = $unapprove_comment");
        if ($Unapprove_comment_query) {
            header("Location: comments.php");  
        }
    } 

    // APPROVE COMMENT
    if (isset($_GET['approve'])) {
        $approve_comment = $_GET['approve'];

        $approve_comment_query = mysqli_query($connect, "UPDATE comments SET comment_status = \"approved\" WHERE comment_id = $approve_comment");
        if ($approve_comment_query) {
            header("Location: comments.php");  
        }
    } 


    
    if (isset($_GET['delete_comment'])) {
        $delete_comment_id = $_GET['delete_comment'];

        $Query_delete = mysqli_query($connect, "DELETE FROM comments WHERE comment_id = $delete_comment_id ");
        if ($Query_delete) {
            header("Location: comments.php");  
        }
    }
    
 ?>
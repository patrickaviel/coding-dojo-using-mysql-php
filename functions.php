<?php
function query_all_posts($message_id){
        $query_comment = "SELECT messages.id,comments.user_id,comments.id as comment_id,comments.comment,comments.created_at,users.first_name,users.last_name FROM comments INNER JOIN messages ON comments.message_id = messages.id INNER JOIN users ON comments.user_id = users.id WHERE comments.message_id=$message_id ORDER BY created_at ASC";
        $result_comments = fetch_all($query_comment);
        foreach($result_comments as $row){
            $date=date_create($row['created_at']);
            $format_date = date_format($date,"F d, Y");
            $message_id=$row['id'];
            echo "<h4>{$row['first_name']}  {$row['last_name']} - $format_date</h4>";
            echo "<p>{$row['comment']}</p>";
            if($row['user_id']==$_SESSION['user_id']){
                echo "<a href='delete_record.php?comment_id={$row['comment_id']}' class='delete'>Delete Post</a>";
            }
        }
    }
?>
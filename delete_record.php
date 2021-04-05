<?php
    require('new-connection.php');

    if(isset($_GET['message_id'])){
        $query = "DELETE FROM messages WHERE id={$_GET['message_id']}";
        $results = run_mysql_query($query);
        header('location:success.php');
        die();
    }
    if(isset($_GET['comment_id'])){
        $query = "DELETE FROM comments WHERE id={$_GET['comment_id']}";
        $results = run_mysql_query($query);
        header('location:success.php');
        die();
    }
?>
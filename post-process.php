<?php
    session_start();

    require('new-connection.php');

    if(isset($_POST['action'])&&$_POST['action']=='post_message'){
        post_message($_POST);
    }elseif(isset($_POST['action'])&&$_POST['action']=='comment'){
        post_comment($_POST);
    }else{
        session_destroy();
        header('location:index.php');
    }

    function post_message($post){
        if(empty($_POST['post'])){
            header('success.php');
            die();
        }
        if(!empty($_POST['post'])){
            $query="INSERT INTO messages (message,user_id,created_at,updated_at) VALUES ('{$post['post']}','{$_SESSION['user_id']}',NOW(),NOW())";
            run_mysql_query($query);
            $_SESSION['message']="Success!";
            header('location:success.php');
            die();
        }
    }

    function post_comment($post){
        if(empty($_POST['comment'])){
            $_SESSION['message']="Fail!";
            header('success.php');
            die();
        }
        if(!empty($_POST['comment'])){
            $query="INSERT INTO comments (comment,user_id,message_id,created_at,updated_at) VALUES ('{$post['comment']}','{$_SESSION['user_id']}','{$post['post_id']}',NOW(),NOW())";
            run_mysql_query($query);
            $_SESSION['message_comment']="<script type='text/javascript'>alert('Success');</script>";
           
            header('location:success.php');
            die();
        }
    }
    
?>